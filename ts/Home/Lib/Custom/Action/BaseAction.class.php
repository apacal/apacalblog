<?php
/* BaseAction 前台基础类，封装了字符串处理，登录，验证，验证码等
 *
 * @author Apacal
 * time 2013.05.09
 *
 */
class BaseAction extends Action {
    /**
     * 得到自动提交的结果
     **/
    public function getTitle($string) {
        $pattern = "/\<h1\>[\s\S]*\<\/h2\>/";
        if(preg_match($pattern,$string,$match)){//获取特定的字符串
        //将flash转化为html的表格
            $str=$match[0];
        }
        $pat [0] = "/\<h1\>/";
        $pat [1] = "/\<\/h1\>/";
        $pat [2] = "/\<h2\>/";
        $pat [3] = "/\<\/h2\>/";

        $re [0] ='';
        $re [1] ='';
        $re [2] ='';
        $re [3] ='';

        $str=preg_replace($pat,$re,$str);
        return $str;

        
    }
    /* 字符串处理
     * @author Apacal
     *
     */
    public function get_html_data($string){
        $pattern="/function[\s\S]*leibie\(\'o3\'\)\;\s+}/";
        if(preg_match($pattern,$string,$match)){//获取特定的字符串
        //将flash转化为html的表格
        $str=$match[0];
        }else
            echo "请重新复制数据";
        //$str=$matches;
        $pa[0]="/function/";
        $pa[1]="/\(\)\s+\{/";
        $pa[2]="/flashvalue\s+\=\s+\"\<set\s+name\=\'/";
        $pa[3]="/flashvalue\s+\+\=\s+\"\<set\s+name\=\'\S{6}\w\S{3}/";
        $pa[4]="/demo\'\s+value\=\'/";
        $pa[5]="/createflash\(flashvalue,\s+\"chartdiv\"\,\"\w{2,5}\"\)\;/";
        $pa[6]="/\'\scolor\=\'\#\w{6}\'\s+\/\>\"/";
        $pa[7]="/createflash\(flashvalue\,\"chartdivm\"\,\"\w{2,5}\"\)\;\s+leibie\(\'\w{2,5}\'\)\;\s+}/";
        $pa[8]="/\'\s+\/\>\"/";
        $pa[9]="/\'\s+value\=\'/";

        $re[0]='<div class="mydiv"><b class=myb>最近24小时&nbsp;<font color=red>';
        $re[1]="&nbsp;</font>的趋势</b><br>";
        $re[2]='<b class=myb>开始时间：';
        $re[3]="demo";
        $re[4]="<tr><td>";
        $re[5]='</table></div><div class="mydiv"><b class=myb>最近一个月趋势</b></br>';
        $re[6]="</td></tr>";
        $re[7]='</table></div>';
        $re[8]="";
        $re[9]="</b><br><br><table class=mytable border=1><tr><td>";




        $str=preg_replace($pa,$re,$str);
        return $str;
    }
    /* 用户登录
     * @author Apacal
     *
     */
    public function login() {
        $this->display();
    }
    /*
     * 验证码生成
     * @author Apacal
     * time 2013.05.04
     *
     */
    public function verify() {
        $type=isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
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
        $User=M('User');
        $auth_info=$User->where($map)->find();
        if(empty($auth_info)) {
            $this->error('账号不存在或者已经禁用');
        }else{
            if($auth_info['password']!=md5($_POST['password'])){
                $this->error('密码错误');
            }
            $_SESSION[C('USER_AUTH')]=$auth_info['id'];
        
            $_SESSION['user_email']=$auth_info['email'];
            $_SESSION['user_name']=$auth_info['user_name'];
            $_SESSION['login_time']=$auth_info['last_login_time'];
            $_SESSION['count']=$auth_info['login_count'];
           
            //保存登录信息
            $data['id']=$auth_info['id'];
            $data['last_login_time']=time();
            $data['login_count']=array('exp','login_count+1');
            $data['last_login_ip']=get_client_ip();
            $User->save($data);
            $this->success('登陆成功',__URL__.'/index');
        }

    }
     /* 用户登出
     * @author
     * time 2013.05.05
     *
     */
    public function logout() {
        if(isset($_SESSION[C('USER_AUTH')])) {
            unset($_SESSION[C('USER_AUTH')]);
            unset($_SESSION);
            session_destroy();
            $this->success('登出成功！',__URL__.'/index');
        }else {
            $this->error('已经登出！');
        }
    }
    /* 检查用户是否登录
     * @author Apacal
     * time 2013.05.04
     *
     */
    public function checkAdmin(){
        if(!isset($_SESSION[C('USER_AUTH')])) {
            $this->error('没有登录,请先登录','__ROOT__/index.php/Index/login');
        }
    }
}
