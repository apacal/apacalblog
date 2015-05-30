<?php
namespace Home\Controller;
use Home\Model\ArticleModel;
use Home\Model\BookModel;
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

    public function index($cid = 0, $page = 1){
        if ($cid != 0 && (!is_numeric($cid))) {
            $this->error('参数错误!');
        }
        if (!is_numeric($page)) {
            $this->error('参数错误!');
        }

        $articleModel = new ArticleModel();
        $totalPageCount = $articleModel->getTotalPageCountByCategory($cid);

        if ($page > 1 && !empty($totalPageCount)) {
            $pageTitle = "RESULTS:(PAGE $page OF $totalPageCount)";
            $this->assign('new_url', U(CONTROLLER_NAME .'/' .ACTION_NAME, array('cid' => $cid, 'page' => ($page - 1))));
        }
        if (empty($totalPageCount)) {
            $pageTitle = "NOT RESULTS";
        }

        if (isset($pageTitle)) {
            $this->assign('page_title', $pageTitle);
        }


        if ($totalPageCount > $page) {
            $this->assign('old_url', U(CONTROLLER_NAME .'/' .ACTION_NAME, array('cid' => $cid, 'page' => ($page + 1))));
        }


        $articleList = $articleModel->getArticleListByCategory($cid, 0, $page);
        $this->assign('article_list', $articleList);
        $this->assign('recent_article_list', $articleModel->getRecentArticleListByCategory($cid));
        $this->assign('recent_comment_list', (new CommentModel())->getRecentCommentListByCategory($cid, 0, 8));
        $this->assign('archives_list', $articleModel->getArticleListGroupByDateByCategry($cid));
        $this->assign('tags_list', $articleModel->getTagsByCategory($cid));
        $this->seo('首页', NULL, NULL, NULL);
        if ($cid == 0) {
            $this->assign('index', 1);
        }
        $this->display('Index:index');
    }

    public function book() {
        $list = (new BookModel())->getList();
        //var_dump($list);
        $this->assign('list', $list);
        $this->seo('书籍', NULL, NULL, NULL);
        $this->display();
    }

}
