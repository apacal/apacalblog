<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Home\Model\ArticleModel;
use Home\Model\CommentModel;
use Think\Controller;
class ArticleController extends CommonController {
    public function index(){
        $cid = I('request.cid');
        //var_dump($cid);
        if(empty($cid) || !is_numeric($cid))
            $this->error("参数错误！");
        $dataId = (M('Category')->where(array('id' => $cid, 'status' => 1))->field('id')->find());
        if(empty($dataId))
            $this->error("没有该分类！");

        $articleModel = D('Article');

        $this->assign('articleCount',$articleModel->getArticleCount($cid));
        $this->assign('articleList', $articleModel->getArticleList($cid));
        $this->assign('cid', $cid);
        $this->assign('categoryInfo', ($categoryInfo = $this->getCategoryInfo($cid)));


        $this->assign('hotTitle', '最新文章');
        $this->assign('hotArticleList', ($hotArticleList = $articleModel->getNewlyArticleList($cid,'id DESC, sort DESC', 18)));
        $this->assign('hotArticleCount', count($hotArticleList));


        $this->assign('randArticleList', $articleModel->getRandArticleList($cid, 10));
        $position = array();
        $position [] = array('cname' => '列表');
        D('Category')->getPosition($cid, $position);
        $this->seo($categoryInfo['cname'], $categoryInfo['keywords'], $categoryInfo['description'], $position);
        
        $this->display();
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
    public function dateArc() {
        $cid = I('request.cid');
        var_dump($cid);
        $time = I('request.time');
        if(!empty($cid) && $cid != 0) //0表示所有文章归档
            $where['cid'] = array('in', D('Category')->getThisCategoryChildren($cid)); //得到属于$cid的所有栏目的id
        $where['status'] = 1;
        $allList = D('Article')->where($where)->relation(true)->order("sort DESC, createtime DESC")->select();
        $list = array();
        foreach($allList as $value) { //筛选出当前时间挡的文章
            $temp = date('Y-m', $value['createtime']);
            if($temp == $time)
                $list[] = $value;
        }
        if(empty($list))
            $this->error("没有该分类！");
        $this->assign('articleCount', count($list));
        $this->assign('articleList', $list);
        $this->display('dataArc');
    }
    /*
     * 显示更多的文章，供ajax调用
     **/
    public function more() {
        $cid = I('request.cid');
        if(!empty($cid) || is_numeric($cid)) {
            $this->assign('articleList', D('Article')->getArticleList($cid, $page =  I('request.p' ,0 , 'intval'))); //当空为会转为0
            $this->display();
        }else{
            $this->error("参数错误！");
        }
    }
}
