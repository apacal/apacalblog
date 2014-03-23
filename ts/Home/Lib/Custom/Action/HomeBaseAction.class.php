<?php
import("@.Custom.Action.BaseAction");
/**
*  HomeBaseAction 网站Action的基础类
*  主要封装了处理原始数据的操作。
*  @author  Apacal
*
 **/
class HomeBaseAction extends BaseAction{
    
    /* 网站左边菜单栏数据，关于我们和工作进展读取
     * @author Apacal
     * time 2013.05.04
     *
     */
    public function get_left_menu() {
        $AboutUs=M('AboutUs');
        $about_us=$AboutUs->where("open=1")->order("id desc")->limit(3)->select();
        $Progress=M('Progress');
        $progress=$Progress->where("open=1")->order("id desc")->limit(3)->select();
        $this->assign("home_progress",$progress);
        $this->assign("home_about_us",$about_us);
        $Data=M('Data');
        $data=$Data->where("open=1")->order("id desc")->limit(12)->select();
        $this->assign("data",$data);
    }
    
    /* 文章，数据列表
     * @author Apacal
     * 
     *
     * time 2013.05.09
     */
    public function menu(){
        //获取排序的数据，family表示排序的字段表示字段，way表示排序方式
        $way=$_REQUEST['way'];
        $family=$_REQUEST['family'];
        if(!isset($way)){   //初始排序规则
            $way='desc';
            $family='id';
        }
        //字段排序处理完毕

        //对搜索条件进行处理
        $searchKind=$_REQUEST['searchKind'];
        $searchKey=$_REQUEST['searchKey'];
        $search['open']=1;
        if($searchKind==2){
            $search['id']=$searchKey;    
        }
        if($searchKind==1){
            //$search="title like %".$searchKey."%";
            $search['title']=array('like','%'.$searchKey.'%');
        }
        //对搜索条件处理完毕
        $name=$this->getActionName();
        $this->get_left_menu();
        $model=M($name);
        import("ORG.Util.Page");//导入分页类
        $count=$model->where($search)->count();
        $Page=new Page($count,20);
        $list = $model->where($search)->order($family." ".$way)->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('first','第一页');
        $Page->setConfig('last','最后一页');
        $page=$Page->show();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->display();
       
    }
    /* 内容查看
     * @author Apacal
     * time 2013.05.09
     *
     */
    public function details() {
        $this->get_left_menu();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        $volist=$model->where("id=$id")->find();
        if(empty($volist)){
            $this->error('缺少数据');
        }
        $this->assign("volist",$volist);
        $data['click']=array('exp','click+1');//点击量增加1
        $model->where("id=$id")->save($data);
        $condition['id']=array('lt',$id);
        $this->assign("forword",$model->field("id,title,publish_time")->where($condition)->find());
        $condition['id']=array('gt',$id);
        $this->assign("next",$model->field("id,title,publish_time")->where($condition)->find());
        $this->display();
    }


}
?>
