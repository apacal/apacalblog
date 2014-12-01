<?php
/**
 * Article控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {

    public function _before_add() {
        $this->setAllCategoryTree();
    }

    public function _before_edit() {
        $this->setCategoryTree();
    }

    /**
     * 管理界面
     **/
    public function manage() {
        $model = M('Article');
        $cid = I('request.cid');
        $menuId = I('request.menuId');

        if(!empty($cid)) {
            $list = $model->field('content', true)->where(array('cid' => $cid))->order('updatetime DESC')->select();
        }else{
            $list = $model->field('content', true)->order('updatetime DESC')->select();
        }
        foreach($list as &$val) {
            $val['url'] = $this->getEditUrl( $val, $menuId );
            $val['cateUrl'] = $this->getManageUrl( $val, $menuId );
            $where['id'] = $val['cid'];
            $val['cname'] = M('Category')->where($where)->getField('cname');
        }
        $this->assign('list', $list);
    }


    private function getManageUrl( $arr, $menuId ) {
        return U(CONTROLLER_NAME .'/manage', array('cid' => $arr['cid'], 'menuId' => $menuId));
    }

    /**
     * 添加博客
     **/
    public function insert() {
        $model= D('Article');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $upload = D('Upload');
        $image = $upload->upload('Article');
        if(!$image){
            $this->error('图片不能为空！');
            //$this->error($upload->getError());
        }
        $data['image'] = $image;
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        $data['content'] = $_REQUEST['content'];
        if(empty($data['source'])){
            $data['source'] = $data['source_url'] =0;
        }
        //$data['content'] = str_replace(array('<div>','</div>'), '', $data['content']);
        if(!$model->add($data)) {
            $this->error($model->getError());
        } else {
            $model->delCache($data['cid']);
            $this->success('添加博文成功!', $this->getUrl(__CONTROLLER__.'/manage'));
        }
    }
    public function uploadimage() {
        $upload = D('Upload');
        $image = $upload->upload('Article', 3, true, 750, 420);
        if(!$image)
            $this->error($upload->getError());
        $image = getThunmName($image);
        echo $image;
    }
    public function upload() {
        $upload = D('Upload');
        $file = $upload->uploadFile('Article', 12);
        if(!$file)
            $this->error($upload->getError());
        //$result = array();
        //$result['file'] = $file;
        //var_dump($file);
		//$this->ajaxReturn($result, 'json');
        echo $file;

    }
    /**
     * 更新博客
     **/
    public function update() {
        $model= D('Article');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $id = I('request.id');
        if(empty($id) || !is_numeric($id))
            $this->error('参数错误！');
        $upload = D('Upload');
        $image = $upload->upload('Article');
        if($image) {
            $data['image'] = $image;
            $src = C('UPLOAD').I('request.old-image');
            $upload->del($src);
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        $where['id'] = $id;
        $data['content'] = $_REQUEST['content'];
        unset($data['createtime']);//unset createtime
       // $data['content'] = str_replace(array('<div>','</div>'), '', $data['content']);
       //var_dump($data);
        if(!$model->where($where)->save($data)) {
            $this->error($model->getError());
        } else {
            $model->delCache($data['cid'], $id);
            $this->success( '更新博文成功!', $this->getUrl(CONTROLLER_NAME .'/manage') );
        }
    }
}

