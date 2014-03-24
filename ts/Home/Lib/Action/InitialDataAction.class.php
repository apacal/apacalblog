<?php
import("@.Custom.Action.HomeBaseAction");
class InitialDataAction extends HomeBaseAction {
    /* 原始数据控制器
     * @author Apacal
     *
     */
    /*  原始数据查看
     *  @author Apacal
     *  time    2013.05.03
     */
    public function details(){
        $this->get_left_menu();
        $InitialData=M('InitialData');
        $condition['id']=$_REQUEST['id'];
        $id=$_REQUEST['id'];
        $initial_data=$InitialData->where($condition)->find();
        $initial_data['content']=htmlspecialchars($initial_data['content']);
        if(empty($initial_data)){
            $this->assign("error",'缺少数据!');
            $this->error();
        }
        /* 点击量统计
        $Data->setInc('click',"id='$id'",1);
         */
        $this->assign('volist',$initial_data);
        $condition['id']=array('lt',$id);
        $this->assign("forword",$InitialData->field("id,title,publish_time")->where($condition)->find());
        $condition['id']=array('gt',$id);
        $this->assign("next",$InitialData->field("id,title,publish_time")->where($condition)->find());
        $this->display();
    }

    
}
