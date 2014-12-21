<?php
/**
 * Article控制器
 **/
namespace Admin\Controller;
use Admin\Model\ArticleModel;
use Admin\Model\TermModel;
use Admin\Model\UploadModel;
use Think\Controller;
class ArticleController extends CommonController {

    public function _before_add() {
        $this->setAllCategoryTree();
    }

    public function _before_edit() {
        $model = new TermModel();
        $tags = $model->getTermsByObjectIdAndTaxonomy(CONTROLLER_NAME, $_REQUEST['id']);
        if(is_array($tags)) {
            $new = array();
            foreach($tags as $val) {
                $new[] = $val['name'];
            }
            $tags = json_encode($new);

        }
        $this->assign('tags', $tags);
        $systemTags = $model->getTermsByTaxonomy(CONTROLLER_NAME);
        $this->assign('system_tags', $systemTags);
        $this->setAllCategoryTree();
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
            $val['cateUrl'] = $this->getManageUrlByCateId( $val['cid'], $menuId );
            $where['id'] = $val['cid'];
            $val['cname'] = M('Category')->where($where)->getField('cname');
        }
        $this->assign('list', $list);
    }


    private function getManageUrlByCateId( $cid, $menuId ) {
        return U(CONTROLLER_NAME .'/manage', array('cid' => $cid, 'menuId' => $menuId));
    }


    public function uploadImage() {
        $upload = new UploadModel();
        $image = $upload->uploadImage('Article', 3, true, 750, 420);

        $this->jsonReturn($image, $upload->getError());
    }

    public function upload() {
        $upload = new UploadModel();
        $file = $upload->uploadFile('Article', 12);
        $this->jsonReturn($file, $upload->getError());
    }

    protected function jsonReturn($msg, $error) {
        $data = array();
        if(false !== $msg) {
            $data['msg'] = $msg;
            $data['code'] = 0;
        } else {
            $data['code'] = -1;
            $data['msg'] = $error;
        }
        die(json_encode($data));
    }


    /**
     * 添加博客
     **/
    public function insert() {
        $model= new ArticleModel();
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $this->initPostData($data);
        if(empty($data['source'])){
            $data['source'] = $data['source_url'] =0;
        }
        if(false === ($id = $model->add($data))) {
            $this->error($model->getError());
        } else {
            $this->saveTags($id);
            $this->success('添加博文成功!', $this->getManageUrl(__CONTROLLER__.'/manage'));
        }
    }

    protected function initPostData(&$data) {
        $upload = new UploadModel();
        $image = $upload->uploadImage('Article');
        if($image != false){
            $data['image'] = $image;
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        $data['content'] = $_REQUEST['content'];
        if(empty($data['source'])){
            $data['source'] = $data['source_link'] =0;
        }

    }
    /**
     * 更新博客
     **/
    public function update() {
        $model= new ArticleModel();
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $id = I('request.id');
        if(empty($id) || !is_numeric($id)) {
            $this->error('参数错误！');
        }
        $this->initPostData($data);

        $where['id'] = $id;
        unset($data['createtime']);//unset createtime
        if(!$model->where($where)->save($data)) {
            $this->error($model->getError());
        } else {
            $this->saveTags($id);
            $this->success( '更新博文成功!', $this->getManageUrl(CONTROLLER_NAME .'/manage') );
        }
    }

    protected function saveTags($id) {
        $terms = new TermModel();
        $tags = json_decode($_REQUEST['tags']);
        if (is_array($tags)) {
            $terms->saveTerms(CONTROLLER_NAME, $id, $tags);
        }


    }
}

