<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-12-30
 * Time: 下午3:02
 */

namespace Home\Controller;


use Admin\Model\UploadModel;
use Admin\Model\UserModel;
use Think\Image;
use Think\Model;
use Think\Verify;

class UserController extends CommonController{
    public function view() {
        $uid = I('get.id');
        if (empty($uid) || !is_numeric($uid)) {
            $this->error("param error !");
        }
        $User = new UserModel();
        $userInfo = $User->getUserInfo($uid);
        if (empty($userInfo)) {
            $this->error("use not exist!");
        }
        $this->initBackgroundUrl();

        $this->assign('vo', $userInfo);
        $this->display();
    }

    public function saveAvatar() {
        $uid = $this->checkLogin();
        $file = $this->cropAvatar();
        $User = new UserModel();
        $data = array(
            'image' => $file,
        );
        if ($User->update($uid, $data)) {
            $this->success("update avatar success!");
        } else {
            $this->error("updata avatar fail!");
        }

    }
    private  function cropAvatar() {
        $Image = new Image();
        $file = I('post.image');
        if (!empty($file)) {
            $file = '.' .$file;
        } else {
            $this->error("file not exist!");
        }
        $Image->open($file);
        $Image->crop( I('post.w'), I('post.h'),I('post.x'), I('post.y'), 150, 150);
        $Image->save($file);
        return trim($file, '.');
    }

    public function uploadAvatar() {
        $Upload = new UploadModel();
        $avatar = $Upload->uploadImage('Avatar');
        if (empty($avatar)) {
            $data = array(
                'error' => $Upload->getError(),
                'code' => 1,
            );
        } else {
            $data = array(
                'data' => $avatar,
                'code' => 0,
            );
        }
        $this->jsonReturn($data);

    }



    public function savePassword() {
        $uid = $this->checkLogin();
        $User = new UserModel();
        $userInfo = $User->getUserInfo($uid);


        if (isset($userInfo['pwd'])) {
            if (checkPasswd(I('post.old_password'), $userInfo['pwd']) === false) {
                $this->error("old password is not correct, please try enter correct password!");
            }
        } else {
            $this->error("user is not exist!");
        }


        if (I('post.password') !== I('post.repassword')) {
            $this->error("repassword is not correct!");
        }

        $data = array();
        $data['pwd'] = createHash(I('post.password'));

        if($User->update($uid, $data)) {
            $this->destroyUserLogin();
            $this->success("update user password success!", U('User/index' .C('URL_HASH')));
        } else {
            $this->error("some error exist in database, please tell it to admin!");
        }



    }

    /**
     * save user base info, like name, email, website
     */
    public function saveBaseInfo() {
        $uid = $this->checkLogin();
        $User = new UserModel();
        $data = $User->create(I('post'), Model::MODEL_UPDATE);

        if ($User->checkUserExit($uid, $data['name']) === true) {
            $this->error("use have exist!");
        }

        if (false === $User->update($uid, $data))  {
            $this->error("update fail!");
        } else {
            $this->success("update success！", U('User/index' .C('URL_HASH')));
        }


    }


    /**
     * show change user info page
     */
    public function index() {
        $uid = $this->checkLogin();
        $User = new UserModel();
        $userInfo = $User->getUserInfo($uid);
        $this->initBackgroundUrl();
        $this->assign('vo', $userInfo);
        $this->display();
    }

    /**
     * show login page
     */
    public function login() {
        $this->initBackgroundUrl();
        $this->display();
    }

    /**
     * logout user and destroy session
     */
    public function logout() {
        $this->destroyUserLogin();
        $this->success("logout success！", U('User/login' .C('URL_HASH')), 2);
    }

    /**
     * destroy user login info
     */
    protected function destroyUserLogin() {
        session_destroy();
        session_regenerate_id(true);
    }

    /**
     * show register page
     */
    public function register() {
        $this->initBackgroundUrl();
        $this->display();
    }

    /**
     * add a use for register page
     */
    public function add() {
        $this->checkVerify();
        $model= new UserModel();
        if(!($data = $model->create(I('post'), Model::MODEL_INSERT))) {
            $this->error($model->getError());
        }

        $data['pwd'] = createHash(I('post.password'));
        $uid = $model->insert($data);
        if (!empty($uid)) {
            setUserLogin($uid);
            setUserInfo($data);
            $this->success('register success！', U('User/index' .C('URL_HASH')));
        } else {
            $this->error("register error！");
        }
    }

    /**
     * check user password is correct and set user login info
     */
    public function checkPassword(){
        $this->checkVerify();
        if (is_login() > 0) {
            $this->error("you have been login！");
        }
        $name = I('post.name');
        $password = I('post.password');
        if(empty($name)) {
            $this->error('losing name！');
        }elseif(empty($password)){
            $this->error('losing password！');
        }


        $User = new UserModel();
        $authInfo = $User->getUserInfoByName($name);

        //使用用户名、密码和状态的方式进行认证
        if(false === $authInfo) {
            $this->error('use not exist！');
        } else {

            if(!checkPasswd($password, $authInfo['pwd'])) {
                $this->error('password or username incorrect');
            }
            if($authInfo['status'] == 0){
                $this->error('user have been forbidden！');
            }

            setUserLogin($authInfo['uid']);

            setUserInfo($authInfo);
            setCommentUserInfo($authInfo);
            //保存登录信息
            $ip = get_client_ip();
            $time = time();
            $data = array();
            $data['uid'] = $authInfo['uid'];
            $data['logintime'] = $time;
            $data['loginip'] = $ip;
            $User->save($data);


            $this->success('login success！', U('User/index' .C('URL_HASH')), 2);


        }
    }

    /**
     * init login,register and so on page background image url
     */
    private function initBackgroundUrl() {
        $this->assign('background_url', "http://wallpapers.apacal.cn/cgi/");
    }

    /**
     * check verify is valid, the input name must be verify
     */
    protected function checkVerify() {
        if(false === VerifyController::check($_REQUEST['verify'])) {
            $this->error("verify incorrect!");
        }
    }

    /**
     * check if user is login, if login return uid, or return false
     * @return false|int
     */
    private function checkLogin() {
        $uid = is_login();
        if ($uid > 0) {
            return $uid;
        } else {
            $this->error("You need to login!", U('User/login'), 2);
            return false;
        }
    }
}