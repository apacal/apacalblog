<?php
import("@.Custom.Action.AdminBaseAction");
class ArticleAction extends AdminBaseAction {
    /* 文章管理类
     * @author Apacal
     *
     */
    /* 更新数据 
     * @author Apacal
     *
     */
    public function update() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=D($name);
        if(!$model->create()) {
            $this->error($model->getError());
        }else{
            if($model->save()){
                $this->success('编辑成功','__URL__/manager');
            }else{
                $this->error('编辑失败');
            }
        }
    }
    /* 新文章添加保存
     *
     */
    public function save() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=D($name);
        if(!$model->create()){
            $this->error($model->getError());
        }else{
            if($model->add($data)){
                $this->success('添加数据成功');
            }else{
                $this->error('添加数据失败');
            }
        }
    }
}
