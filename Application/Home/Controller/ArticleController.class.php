<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Admin\Model\TermModel;
use Home\Model\ArticleModel;
use Home\Model\CommentModel;
use Think\Controller;
class ArticleController extends CommonController {
    public function index($cid = 0){
        R('Index/index', array('cid' => $cid));
    }

    /**
     * 获取当前分类的信息
     * @param $cid
     **/
    protected function getCategoryInfo($cid) {
        $info = M('Category')->where(array('id' => $cid))->find();
        $admin = M('Admin')->where(array('adminid' => $info['adminid']))->find();
        $info['adminname'] = $admin['adminname'];
        $info['adminimage'] = $admin['image'];
        return $info;
    }

    public function view(){
        $id = I('request.id');
        if(empty($id) || !is_numeric($id)) {
            $this->error("参数错误!");
        }

        $Article = new ArticleModel();
        $article = $Article->getArticleById($id);
        if(empty($article)) {
            $this->error("没有该文章!");
        }
        $Article->setIncClickById($id, 'click');

        $this->assign('art_vo', $article);
        $this->assign('post_uid', $article['adminid']);
        $this->assign('recent_article_list',$Article->getRecentArticleListByCategory($article['cid'], $article['id']));
        $this->assign('archives_list', $Article->getArticleListGroupByDateByCategry($article['cid']));
        $this->assign('tags_list', $Article->getTagsByCategory($article['cid']));

        // readNext
        $next = $Article->getNextArticleByCategory($article['cid'], $article['createtime']);
        $this->assign('next', $next);
        $prev = $Article->getPrevArticleByCategory($article['cid'], $article['createtime']);
        $this->assign('prev', $prev);


        // 评论
        $Comment = new CommentModel();
        $this->assign('recent_comment_list', $Comment->getRecentCommentListByCategory($article['cid'], $article['id'], 8));
        $commentList = $Comment->getCommentListByCidAndOid($article['cid'], $article['id']);
        $this->assign('comment_list', $commentList);
        $this->assign('comment_count', $Comment->getCommentCount($article['cid'], $article['id']));



        $this->seo($article['title'], $article['keywords'], $article['description']);
        $this->display();
    }

    /**
     * 时间归类
     **/
    public function date($cid = 0) {
        if (!is_numeric($cid)) {
            $this->error('参数错误！');
        }
        $startTime = strtotime(I('time'));
        $endTime = strtotime(I('time') ."+1 month");

        $articleModel = new ArticleModel();

        $where = array(
            'status' => 1,
            'cid' => $cid,
            'createtime' => array('between', array($startTime,$endTime)),
        );
        $articleList = $articleModel->getArticleListByWhere($where);
        if (empty($articleList)) {
            $this->error("没有该归档！");
        }
        $this->assign('article_list', $articleList);
        $this->assign('recent_comment_list', (new CommentModel())->getRecentCommentListByCategory($cid, 0, 8));
        $this->assign('recent_article_list', $articleModel->getRecentArticleListByCategory($cid));
        $this->assign('archives_list', $articleModel->getArticleListGroupByDateByCategry($cid));
        $this->assign('tags_list', $articleModel->getTagsByCategory($cid));
        $this->seo('首页', NULL, NULL, NULL);
        $this->display('Index:index');
    }

    public function tag($name = 'LINUX') {
        $cid = 0;
        $articleModel = new ArticleModel();

        $articleList = $articleModel->getArticleListByTag($name);

        if(empty($articleList)) {
            $this->error('没有该' .$name .'!');
        }

        $this->assign('article_list', $articleList);
        $this->assign('recent_comment_list', (new CommentModel())->getRecentCommentListByCategory($cid, 0, 8));
        $this->assign('recent_article_list', $articleModel->getRecentArticleListByCategory($cid));
        $this->assign('archives_list', $articleModel->getArticleListGroupByDateByCategry($cid));
        $this->assign('tags_list', $articleModel->getTagsByCategory($cid));
        $this->seo('首页', NULL, NULL, NULL);
        $this->display('Index:index');
    }
}
