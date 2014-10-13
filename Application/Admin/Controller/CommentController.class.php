<?php
/**
 * 评论控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class CommentController extends CommonController {
    public function update() {
        $id = I('request.id');
        if(empty($id) || !is_numeric($id))
            $this->error('参数错误！');
        $data['updatetime'] =time();
        $data['status'] = I('request.status');
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        $where['id'] = $id;
        if(!$model->where($where)->save($data))
            $this->error($model->getError());
        else
            $this->success('更新成功!', __CONTROLLER__.'/manage');
    }
}
