<?php
/**
 * 栏目控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {

    private $info;
    public function _before_add() {
        $this->setAllNavList();
        $this->setAllModelList();
    }
    public function _before_edit() {
        $this->setAllNavList();
        $this->setAllModelList();
    }
    public function edit() {
        $model = M(CONTROLLER_NAME);
        $where['id'] = I('request.id');
        $vo = $model->where($where)->find();
        //$vo['content'] = str_replace(array('<div>','</div>'), '', $vo['content']);
        if($vo['cid']) {
            $where['id'] = $vo['cid'];
            $vo['cname'] = M('Category')->where($where)->getField('cname');
        }
        $this->info = $vo;
        $this->assign('vo', $vo);
    }
    public function _after_edit() {
        $this->setNowCategory();
        $this->display();
    }
    public function setNowCategory() {
        $categoryNow = '现在栏目【'.$this->info['cname'].'】';
        $this->assign('categoryNow', $categoryNow);
        $model = M('Model')->where(array('id' => $this->info['mid']))->find();
        $modelNow = '现在模型【'.$model['mname'].'-'.$model['mcontroller'].'】';
        $this->assign('modelNow', $modelNow);
    }
    /**
     * 添加栏目
     **/
    public function insert() {
        $model= D('Category');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $upload = D('Upload');
        $image = $upload->upload('Category', 3, true, 761, 427, \Think\Image::IMAGE_THUMB_CENTER);
        if(!$image)
            $this->error('图片不能为空！');
        $data['image'] = $image;
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        if(!$model->add($data))
            $this->error($model->getError());
        else
            $this->success('添加栏目成功!', __CONTROLLER__.'/manage');
    }
    /**
     * 更新栏目
     **/
    public function update() {
        $model= D('Category');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $id = I('request.id');
        if(empty($id) || !is_numeric($id))
            $this->error('参数错误！');
        $upload = D('Upload');
        $image = $upload->upload('Category', 3, true, 761, 427, \Think\Image::IMAGE_THUMB_CENTER);
        if($image) {
            $data['image'] = $image;
            $src = C('UPLOAD').I('request.old-image');
            $upload->del($src);
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        unset($data['createtime']);//unset createtime
        $where['id'] = $id;
        if(!$model->where($where)->save($data))
            $this->error($model->getError());
        else
            $this->success('更新栏目成功!', __CONTROLLER__.'/manage');
    }
}
