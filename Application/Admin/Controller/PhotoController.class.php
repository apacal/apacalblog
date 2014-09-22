<?php
/**
 * Photo控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class PhotoController extends CommonController {
    public function _before_edit() {
        $id = I('request.id');
        if(!is_numeric($id)) {
            $this->error("参数错误！");
        }
        $where['pid'] = $id;
        $model = M('Image');
        if(($list = $model->where($where)->order('createtime DESC')->select()) == false){
            //$this->error($model->getError());
        }
        $this->assign('images', $list);
    }
    public function insert() {
        $model= D('Photo');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $upload = D('Upload');
        $image = $upload->upload('Photo');
        if(!$image){
            $this->error('图片不能为空！');
            //$this->error($upload->getError());
        }
        $data['image'] = $image;
        if(!$model->add($data))
            $this->error($model->getError());
        else
            $this->success('添加相册成功!', __CONTROLLER__.'/manage');
    }
    public function uploadimage() {
        $upload = D('Upload');
        $image = $upload->upload('Photo', 3, true, 750, 420);
        if(!$image)
            $this->error($upload->getError());
        $image = getThunmName($image);
        echo $image;
    }
    public function update() {
        $model= D('Photo');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $id = I('request.id');
        if(empty($id) || !is_numeric($id))
            $this->error('参数错误！');
        $upload = D('Upload');
        $image = $upload->upload('Photo');
        if($image) {
            $data['image'] = $image;
            $src = C('UPLOAD').I('request.old-image');
            $upload->del($src);
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        $where['id'] = $id;
        unset($data['createtime']);//unset createtime
       //var_dump($data);
        if(!$model->where($where)->save($data))
            $this->error($model->getError());
        else
            $this->success('更新相册成功!', __CONTROLLER__.'/manage' );
    }
}

