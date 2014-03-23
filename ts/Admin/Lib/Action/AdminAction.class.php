<?php
import("@.Custom.Action.AdminBaseAction");
class AdminAction extends AdminBaseAction {
    /* 管理员管理类
     * @author Apacal
     *
     */
   /* 设置为超级管理员
     * @author Apacal
     *
     */
    public function setRoot() {
        $this->checkStatus();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        if (isset($id)) {
            $map['group']=1;
            if($model->where("id=$id")->save($map)){
                $this->success('设置为超级管理员成功');
            }else{
                $this->error('已经是超级管理员');
            }
        }else{
            $this->error('非法操作');
        }
    }
    /* 设置为管理员
     * @author Apacal
     *
     */
    public function unSetRoot(){
        $this->checkStatus();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        if(isset($id)){
            $map['group']=0;
            if($model->where("id=$id")->save($map)){
                $this->success("设置为管理员成功");
            }else{
                $this->error("已经为管理员");
            }
        }else{
            $this->error('非法操作');
        }
    }
    
}
