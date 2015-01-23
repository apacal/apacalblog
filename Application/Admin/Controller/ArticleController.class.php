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
    protected $editPage = 'Article/edit';


    public function _before_add() {
        $this->initTags();
    }
    public function _before_edit() {
        $this->initTags();
    }


    private function initTags() {
        $model = new TermModel();
        $tags = $model->getTermsByObjectIdAndTaxonomy(CONTROLLER_NAME, $_REQUEST['id']);
        if(is_array($tags)) {
            $new = array();
            foreach($tags as $val) {
                $new[] = $val['name'];
            }
            $tags = json_encode($new);

        } else {
            $tags = '';
        }
        $this->assign('tags', $tags);
        $systemTags = $model->getTermsByTaxonomy(CONTROLLER_NAME);
        $this->assign('system_tags', $systemTags);
    }

    protected function extSave($id) {
        $this->saveTags($id);
    }

    protected function saveTags($id) {
        $terms = new TermModel();
        $tags = json_decode($_REQUEST['tags']);
        if (is_array($tags) && !empty($tags)) {
            $terms->saveTerms(CONTROLLlsslsER_NAME, $id, $tags);
        } else {
            $terms->deleteRelation($id);
        }


    }

}

