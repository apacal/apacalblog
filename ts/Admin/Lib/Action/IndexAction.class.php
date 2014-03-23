<?php
import("@.Custom.Action.AdminBaseAction");
class IndexAction extends AdminBaseAction {
     /* 后台默认控制器，用户登录，注销，和登录判断
      * @author Apacal
      * time 2013.05.04
      *
      */
    
    /* 后台登录界面
     * @author Apacal
     * time 2013.05.04
     *
     */
    public function login() {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->success('已经登录,正在跳转到后台','__URL__/index');
        }else{
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->display();
        }
        else{
            $this->redirect('Index/index');
        }
        }
    }
   
    /* 登录检查
     * @author Apacal
     * time 2013.05.04
     *
     */
    public function check_login() {
        if(empty($_POST['name'])){
            $this->error('账号必须!');
        }elseif(empty($_POST['password'])){
            $this->error('密码必须！');
        }elseif(empty($_POST['verify'])){
            $this->error('验证码必须！');
        }
        //生成认证条件
        $map=array();
        $map['name']=$_POST['name'];
        //$map["status"]=array('gt',0);
        if(session('verify')!=md5($_POST['verify'])){
            $this->error('验证码错误');
        }
        $Admin=M('Admin');
        $auth_info=$Admin->where($map)->find();
        if(empty($auth_info)) {
            $this->error('账号不存在或者已经禁用');
        }else{
            if($auth_info['password']!=md5($_POST['password'])){
                $this->error('密码错误');
            }
            $_SESSION[C('USER_AUTH_KEY')]=$auth_info['id'];
            $_SESSION['email']=$auth_info['email'];
            $_SESSION['status']=$auth_info['status'];
            $_SESSION['group']=$auth_info['group'];
            $_SESSION['login_user_name']=$auth_info['name'];
            $_SESSION['last_login_time']=$auth_info['last_login_time'];
            $_SESSION['login_count']=$auth_info['login_count'];
            if($auth_info['name']='admin') {
                $_SESSION['administrator']=true;
            }
            //保存登录信息
            $data['id']=$auth_info['id'];
            $data['last_login_time']=time();
            $data['login_count']=array('exp','login_count+1');
            $data['last_login_ip']=get_client_ip();
            $Admin->save($data);
            $this->success('登陆成功',__URL__.'/index');
        }

    }
    /* 用户登出
     * @author
     * time 2013.05.05
     *
     */
    public function logout() {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->success('登出成功！',__URL__.'/login/');
        }else {
            $this->error('已经登出！');
        }
    }

}
