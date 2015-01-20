<?php
/**
 * Article控制器
 **/
namespace Admin\Controller;
use Admin\Model\ArticleModel;
use Admin\Model\CategoryModel;
use Admin\Model\TermModel;
use Admin\Model\UploadModel;
use Think\Controller;
class ArticleController extends CommonController {

    protected $unManageField = array("updatetime", "content", "keywords", "image");


    private function initTags() {
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


    protected function saveTags($id) {
        $terms = new TermModel();
        $tags = json_decode($_REQUEST['tags']);
        if (is_array($tags)) {
            $terms->saveTerms(CONTROLLER_NAME, $id, $tags);
        }


    }

}

