<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function _initilize() {
    }
    //　登录
    public function login(){
        if (!checkMemcahed() && C('NoCachedDie')) {
            $this->error('can not connect memcahed!');
        }
        //$this->display();
    }
    /* ===========================================================================*/
    /**
        * @brief checkPasswd 判断密密码
        *
        * @param    $passwd
        * @param    $hash
        *
        * @returns  
     */
    /* ===========================================================================*/
    protected function checkPasswd($passwd, $hash) {
        $params = explode(":", $hash);
        if(count($params) < 2)
            return false;
        $salt = $params[1];
        $passwd = base64_decode($salt) .$passwd .C('SALT');
        if(hash('sha256', $passwd) == $params[0])
            return true;
        else
            return false;
    }
	public function checkLogin(){
        //$this->checkVerify();
        $username = I('post.username');
        $password = I('post.password');
		if(empty($username)) {
			$this->error('请填写用户名！',__CONTROLLER__.'/login');
		}elseif(empty($password)){
			$this->error('请填写密码！', ___CONTROLLER__.'/login');
		}
		//生成认证条件
		$map = array();
		// 支持使用绑定帐号登录
		$where['adminname'] = $username;
		//$where["status"] = array('gt',0);
		$authInfo = M('Admin')->where($where)->find();
		//使用用户名、密码和状态的方式进行认证
		if(false === $authInfo) {
			$this->error('帐号或密码错误！');
		}else {
			if(!$this->checkPasswd($password, $authInfo['pwd'])) {
				$this->error('账号或密码错误！');
			}
			//是否禁用
			if($authInfo['status'] == 0){
				$this->error('账号已被管理员禁用！');
			}
			$_SESSION[C('ADMIN_AUTH_KEY')] = $authInfo['adminid'];
			$_SESSION['adminid'] = $authInfo['adminid'];
			$_SESSION['adminname'] = $authInfo['adminname'];
			$_SESSION['image'] = $authInfo['image'];
			$_SESSION['lastLoginTime'] = $authInfo['logintime'];
			//保存登录信息
			$User = M('Admin');
			$ip = get_client_ip();
			$time = time();
			$data = array();
			$data['adminid'] = $authInfo['adminid'];
			$data['logintime'] = $time;
			//$data['login_count']	=	array('exp','login_count+1');
			$data['loginip'] = $ip;
			$User->save($data);

			$this->success('登录成功！',__MODULE__.'/Index/index');

		}
	}

	//注销登录
	public function logout(){
		if(isset($_SESSION[C('ADMIN_AUTH_KEY')])) {
			unset($_SESSION[C('ADMIN_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
			$this->success('退出成功！',__CONTROLLER__.'/login/');
		}else {
			$this->error('无需重复退出！');
		}
	}
    public function checkVerify() {
        $verify = new \Think\Verify();
        $code = I('post.verify');
        $id = '';
        if(!($verify->check($code, $id)))
            $this->error("验证码错误!", __CONTROLLER__.'/login');
    }
    public function verify() {
        $config =    array(
            'fontSize'    =>    50,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
         //   'useImgBg'    =>    true, //开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
        );
        $Verify =     new \Think\Verify($config);
        $Verify->entry();
    }
}
