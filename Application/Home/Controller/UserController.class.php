<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-12-30
 * Time: 下午3:02
 */

namespace Home\Controller;


use Admin\Model\UserModel;
use Home\Model\WallpapersModel;
use Think\Model;
use Think\Verify;

class UserController extends CommonController{
    public function view() {
        $this->success("正在完善！");
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
            $this->error("用户已经存在!");
        }

        if (false === $User->update($uid, $data))  {
            $this->error("更新失败!");
        } else {
            $this->success("更新成功！", U('User/index' .C('URL_HASH')));
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
        $this->success("退出成功！", U('User/login' .C('URL_HASH')));
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
            $this->success('注册成功！', U('User/index' .C('URL_HASH')));
        } else {
            $this->error("注册失败！");
        }
    }

    /**
     * check user password is correct and set user login info
     */
    public function checkPassword(){
        //$this->checkVerify();
        if (is_login() > 0) {
            $this->error("已经登陆！");
        }
        //$this->checkVerify();
        $name = I('post.name');
        $password = I('post.password');
        if(empty($name)) {
            $this->error('请填写用户名！');
        }elseif(empty($password)){
            $this->error('请填写密码！');
        }


        $User = new UserModel();
        $where = array(
            'name' => $name,
        );

        $authInfo = $User->where($where)->find();

        //使用用户名、密码和状态的方式进行认证
        if(false === $authInfo) {
            $this->error('用户不存在！');
        } else {

            if(!checkPasswd($password, $authInfo['pwd'])) {
                $this->error('账号或密码错误！');
            }
            if($authInfo['status'] == 0){
                $this->error('账号已被管理员禁用！');
            }

            setUserLogin($authInfo['uid']);
            setUserInfo($authInfo);
            //保存登录信息
            $ip = get_client_ip();
            $time = time();
            $data = array();
            $data['uid'] = $authInfo['uid'];
            $data['logintime'] = $time;
            $data['loginip'] = $ip;
            $User->save($data);

            $this->success('登录成功！', U('User/index' .C('URL_HASH')));


        }
    }

    /**
     * init login,register and so on page background image url
     */
    private function initBackgroundUrl() {
        $url = (new WallpapersModel())->getWallpapersUrl();
        $this->assign('background_url', $url);
    }

    /**
     * check verify is valid, the input name must be verify
     */
    protected function checkVerify() {
        $verify = new Verify();
        $code = I('post.verify');
        $id = '';
        if(!($verify->check($code, $id)))
            $this->error("验证码错误!");
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
            $this->error("需要登陆!", U('User/login'));
            return false;
        }
    }
}