<?php
namespace Home\Controller;
use Home\Model\ArticleModel;
use Home\Model\CommentModel;
use Home\Model\NoteModel;
use Think\Controller;
class NoteController extends CommonController {

    public function view() {
        // the cid is node controller
        $this->index(9);
    }
    public function index($cid) {
        if (empty($cid) || !is_numeric($cid)) {
            $this->error("参数错误！");
        }
        $this->assign('cid', $cid);

        $this->assign("commentUserInfo" ,getCommentUserInfo());
        $this->assign('page_title', '闲言杂语');
        $model = new NoteModel();
        $list = $model->getNoteList($cid);
        $this->assign('list', $list);
        $this->initRightWidget(0);
        $this->seo('闲言杂语', NULL, NULL, NULL);
        $this->display("Note:index");
    }

    private function initRightWidget($cid) {
        $articleModel = new ArticleModel();

        $this->assign('recent_article_list', $articleModel->getRecentArticleListByCategory($cid));
        $this->assign('recent_comment_list', (new CommentModel())->getRecentCommentListByCategory($cid, 0, 8));
        $this->assign('archives_list', $articleModel->getArticleListGroupByDateByCategry($cid));
        $this->assign('tags_list', $articleModel->getTagsByCategory($cid));
    }
}
