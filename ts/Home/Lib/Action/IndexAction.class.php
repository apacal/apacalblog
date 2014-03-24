<?php
import("@.Custom.Action.HomeBaseAction");
class IndexAction extends HomeBaseAction {
    /*
     * 测试是否可以自动访问网页，然后收集数据
    public function test() {
        $str = file_get_contents("http://localhost/ThinkScientific/trunk/index.php/Index/autoSystemData");
    }
     */
    /* 获取flashnews
     *
     */
    public function getFlashNews() {
        $FlashNews=M('FlashNews');
        $flashNews=$FlashNews->order("position asc")->where("open=1")->select();
        $this->assign("flashNews",$flashNews);
    }
    /* 取消首页原始代码查看
     * @author
     * time 2013.05.04
     * version 1.1
     */
    public function index(){
        $this->get_left_menu();
        $this->getFlashNews();
        //显示10条数据
        $Data=M('Data');
        $data=$Data->order("id desc")->limit(10)->select();
        //$InitialData=M('InitialData');
        //$initial_data=$InitialData->order("id desc")->limit(10)->selet();
        $this->assign("data",$data);
        //显示一片Home文章
        $Home=M('Home');
        $home=$Home->order("id desc")->where("open=1")->find();
       
        $this->assign("home",$home);
        //$this->assign("initial_data",$initial_data);
        $this->display();

    }
    /*
     *  输入原始数据
     *  @author Apacal
     *  time    2013.04.26
     */
     public function input_data(){
         $this->get_left_menu();
         $this->display();

    }
    /*  获得处理完的数据并保存两个版本到数据库
     *  get_html_data()为获得html表格的方法
     *  $get_string 为获得的html代码
     *  @author Apacal
     *  time    2013.05.01
     */
    public function out_data() {
        $this->checkAdmin();
        $this->get_left_menu();
        $str=$_POST['content'];
        $InitialData=M('InitialData');
        if(!$_POST['title'])
            $this->error('标题必须');
        if(!$str)
            $this->error('内容必须');
        $get_string=$this->get_html_data($str);
        $Data=M("Data");
        $dat['title'] = $_POST['title'];
        $dat['publish_time']=time();
        $dat['content']=$str;
        $dat['publish_name']=$_SESSION['user_name'];
        if($InitialData->add($dat)){   
        }else{
            $this->error('写入原始数据失败，返回上级页');
        }
        $dat['content'] = $get_string;
        if($Data->add($dat)){
            $this->assign('get_string',$get_string);
            $this->display();
        }else{
            $this->error('写入处理数据失败，返回上级页');
        }
    }
    /**
     * 自动点击收集数据
     **/
    public function autoData() {
        $this->checkAdmin();
        $this->autoGetData();
    }
    /**
     * 系统自动收集调用的函数，访问的页面
     **/
    public function autoSystemData() {
        $this->autoGetData();
    }
    /**
     * 自动处理收集数据
     **/
    public function autoGetData() {
        $mainUrl [0] ="http://www.pm2d5.com/mon/guangzhou_1.html";
        $mainUrl [1] ="http://www.pm2d5.com/mon/guangzhou_2.html";
        $mainUrl [2] ="http://www.pm2d5.com/mon/guangzhou_3.html";
        $mainUrl [3] ="http://www.pm2d5.com/mon/guangzhou_4.html";
        $mainUrl [4] ="http://www.pm2d5.com/mon/guangzhou_5.html";
        $mainUrl [5] ="http://www.pm2d5.com/mon/guangzhou_6.html";
        $mainUrl [6] ="http://www.pm2d5.com/mon/guangzhou_7.html";
        $mainUrl [7] ="http://www.pm2d5.com/mon/guangzhou_8.html";
        $mainUrl [8] ="http://www.pm2d5.com/mon/guangzhou_9.html";
        $mainUrl [9] ="http://www.pm2d5.com/mon/guangzhou_10.html";
        $mainUrl [10] ="http://www.pm2d5.com/mon/guangzhou_11.html";

        foreach($mainUrl as $value) {
            $url = $value;
            //$this->error($url);
            $this->autoInputData($url);
        }
        $AutoData=M("Data");
        $autoData=$AutoData->where("open=1")->order("id desc")->limit(11)->select();
        $this->assign("autoData",$autoData);
        $this->display();
    }
    public function autoInputData($url) {
        $this->get_left_menu();
        //$this->error($url);
        $InitialData=M('InitialData');
        //$this->error(print_r($str));
        if( !($str = file_get_contents($url)))
            $this->error('原始网页不存在，不存在监测点的信息');
        $title = $this->getTitle($str);
        $get_string=$this->get_html_data($str);
        $Data=M("Data");
        $dat['title'] = $title;
        $dat['publish_time']=time();
        $dat['content']=$str;
        $dat['publish_name']='autoSystem';
        if($InitialData->add($dat)){   
        }else{
            $this->error('写入原始数据失败，返回上级页');
        }
        $dat['content'] = $get_string;
        if($Data->add($dat)){
            
        }else{
            $this->error('写入处理数据失败，返回上级页');
        }
    }
    
}
