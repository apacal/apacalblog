<?php
namespace Home\Controller;
use Home\Model\ArticleModel;
use Home\Model\CommentModel;
use Home\Model\SearchModel;
use Think\Controller;
class IndexController extends CommonController {

    public function search() {
        $cid = 0;
        $content = I('post.s');
        $articleList = (new SearchModel())->getSearchList($content);

        $articleModel = new ArticleModel();


        if ($articleList === false) {
            $pageTitle = "SEARCH RESULTS: \"${content}\" (0 COL)";
        } else {
            $count = count($articleList);
            $pageTitle = "SEARCH RESULTS: \"${content}\" ($count COL)";
        }
        $this->assign('page_title',$pageTitle);
        $this->assign('article_list', $articleList);
        $this->assign('recent_comment_list', (new CommentModel())->getRecentCommentListByCategory($cid, 0, 8));
        $this->assign('recent_article_list', $articleModel->getRecentArticleListByCategory($cid));
        $this->assign('archives_list', $articleModel->getArticleListGroupByDateByCategry($cid));
        $this->assign('tags_list', $articleModel->getTagsByCategory($cid));
        $this->seo('首页', NULL, NULL, NULL);
        $this->display('Index:index');
    }

    public function index($cid = 0){
        if ($cid != 0 && (!is_numeric($cid))) {
            $this->error('参数错误!');
        }

        $articleModel = new ArticleModel();

        $this->assign('recent_comment_list', (new CommentModel())->getRecentCommentListByCategory($cid, 0, 8));
        $this->assign('article_list', $articleModel->getArticleListByCategory($cid));
        $this->assign('recent_article_list', $articleModel->getRecentArticleListByCategory($cid));
        $this->assign('archives_list', $articleModel->getArticleListGroupByDateByCategry($cid));
        $this->assign('tags_list', $articleModel->getTagsByCategory($cid));
        $this->seo('首页', NULL, NULL, NULL);
        $this->display('Index:index');
    }

    public function book() {
        $this->seo('书籍', NULL, NULL, NULL);
        $this->display();
    }
    public function aboutme() {
        $this->seo('About Me', NULL, NULL, NULL);
        $this->display();
    }

}
