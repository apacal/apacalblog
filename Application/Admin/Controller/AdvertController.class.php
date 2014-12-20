<?php
/**
 * 广告控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class AdvertController extends CommonController {

    protected $manageSort = "id DESC";
    /**
     * 添加广告
     **/
    public function insert() {
        $model= D('Advert');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $upload = D('Upload');
        $image = $upload->uploadImage('Advert', 3, true, 761, 427, \Think\Image::IMAGE_THUMB_CENTER);
        if(!$image)
            $this->error('图片不能为空！');
        $data['image'] = $image;
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        if(!$model->add($data))
            $this->error($model->getError());
        else
            $this->success('添加广告成功!', __CONTROLLER__.'/manage');
    }
    /**
     * 更新广告
     **/
    public function update() {
        $model= D('Advert');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $id = I('request.id');
        if(empty($id) || !is_numeric($id))
            $this->error('参数错误！');
        $upload = D('Upload');
        $image = $upload->uploadImage('Advert', 3, true, 761, 427, \Think\Image::IMAGE_THUMB_CENTER);
        if(false != $image) {
            $data['image'] = $image;
            $upload->del(I('post.old-image'));
        } else {
            $error = $upload->getError();
            if (!empty($error)) {
                $this->error($error);
            }
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        unset($data['createtime']);//unset createtime
        $where['id'] = $id;
        if(!$model->where($where)->save($data))
            $this->error($model->getError());
        else
            $this->success('更新广告成功!', __CONTROLLER__.'/manage');
    }
}
