<?php
/**
 * 栏目控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {

    public function _before_add() {
        $this->setAllCategoryTree();
        $this->setAllModelList();
    }
    public function _before_edit() {
        $this->setAllCategoryTree();
        $this->setAllModelList();
    }

    /**
     * set all category select tree
     */
    protected function setAllCategoryTree() {
        $where['status'] = 1;
        $list = M('Category')->where($where)->field('id, pid, cname')->order("sort DESC, pid DESC")->select();
        import('Org.Tree');
        $tree=new \tree($list);
        //格式字符串
        $str="<option value=\$id \$selected>\$spacer\$cname</option>";
        //返回树
        $result = $tree->get_tree(0,$str, -1);
        $this->assign('categoryTree', $result);
    }


    public function manage() {
        $model = D(CONTROLLER_NAME);
        //$list = $model->field($this->field)->order('sort DESC, updatetime DESC')->select();
        $list = $model->getAllCategory();
        $this->assign('list', $list);
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
        $this->assign('vo', $vo);
        $this->setNowCategory($vo);
        $this->display();
    }

    private  function setNowCategory($info) {
        $categoryNow = '现在栏目【'.$info['cname'].'】';
        $this->assign('categoryNow', $categoryNow);
        $model = M('Model')->where(array('id' => $info['mid']))->find();
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
