<?php
import("@.Custom.Action.AdminBaseAction");
class InitialDataAction extends ArticleAction {
    /* 数据管理类
     * @author Apacal
     *
     */
    /* 原始数据编辑，主要处理html标签
     *
     *
     */
     public function editor() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        $vo=$model->where("id=$id")->find();
        $vo['content']=htmlspecialchars($vo['content']);
        $this->assign('vo',$vo);
        $this->display();
    }

    /* 原始数据查看，主要处理html标签
     * @Apacal
     */
     public function details() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        $vo=$model->where("id=$id")->find();
        if(empty($model)){
            $this->error('缺少数据');
        }
        $vo['content']=htmlspecialchars($vo['content']);
        $this->assign('vo',$vo);
        $this->assign("forword",$model->field("id,title,publish_time")->where($condition)->find());
        $condition['id']=array('gt',$id);
        $this->assign("next",$model->field("id,title,publish_time")->where($condition)->find());
        $this->display();
    }
    
}
