<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class ArticleController extends CommonController {

    public function index(){
        $cid = I('request.cid');
        if(empty($cid) || !is_numeric($cid))
            $this->error("参数错误！");
        $dataId = (M('Category')->where(array('id' => $cid, 'status' => 1))->field('id')->find());
        if(empty($dataId))
            $this->error("没有该分类！");
        $this->assign('articleList', D('Article')->getArticleList($cid));
        $this->assign('cid', $cid);
        $this->assign('categoryInfo', ($info = $this->getCategoryInfo($cid)));
        $this->assign('hotArticleList', $this->getHotArticleList($cid, 20));
        $this->assign('articleCount',$this->getArticleCount($cid));
        $position = array();
        $position [] = array('cname' => '列表');
        D('Category')->getPosition($cid, $position);
        $this->seo($info['cname'], $info['keywords'], $info['description'], $position);
        
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
        $model = D('Article');
        if(empty($id) || !is_numeric($id))
            $this->error("参数错误!");
        $article = $model->getArticle($id);
        if(!empty($article)) {
            //热门文章
            $hotArticle = $model->getHotArticle($article['cid']);
            $dateCount = 0; $dateAllCount = 0;
            $this->assign('dateArticle',D('Article')->getDateArticle($dateCount, $article['cid']));
            $this->assign('dateAllArticle',D('Article')->getDateArticle($dateAllCount));
            $this->assign('dateCount', $dateCount);
            $this->assign('dateAllCount', $dateAllCount);
            $hotCount = count($hotArticle);
            $this->assign('hotCount', $hotCount);
            $this->assign('hotArticle', $hotArticle);
            $this->assign('article', $article);
            // readNext
            $readNext = $model->getReadNext($article['cid'], $article['createtime']);
            $this->assign('articleList', $readNext);
            // 随机文章
            $this->assign('randArticle', $this->getRandArticle(5));
            $this->assign('randCount', 5);
            // 评论
            M('Article')->where('id='.$id)->setInc('click');
            $this->setComment($article['id'], $article['cid']);
            
            $position = array();
            $position [] = array('cname' => '正文');
            D('Category')->getPosition($article['cid'], $position);
            $this->seo($article['title'], $article['keywords'], $article['description'], $position);

            $this->display();
        }else{
            $this->error("没有该文章!");
        }
    }
    /**
     * 随机文章
     **/
    protected function getRandArticle($limit = 15) {
        $model = M('Article');
        $list = $model->where(array('status' => 1))->field('click, id, image, title')->select();
        $rand = array_rand($list, $limit);
        $randArticle = array();
        foreach($rand as $val) {
            $randArticle[] = $list[$val];
        }
        return $randArticle;
    }
    /**
     * 获取评论信息
     * @param $id-来源文章id　$cid 分类id
     **/
    protected function setComment($id, $cid) {
        $model = D('Comment');
        //评论数
        $where['oid&status&pid&cid'] = array($id,'1','0',$cid,'_multi' => true);
        $commentCount = $model->where($where)->count();
        //获取最多COMMENT_SHOWNUM的一级评论
        $maxShowComment = C('COMMENT_SHOWNUM');
        if(!isset($maxShowComment) || empty($maxShowComment)) {
            $maxShowComment = 5;
        }
        $comment = $model->where($where)->limit($maxShowComment)->order('createtime ASC')->select();
        if(is_array($comment)) {
            foreach($comment as $key => $val) {
                $comment[$key]['reply'] = $model->where('status=1 AND pid='.$val['id'])->order('createtime ASC')->select();
                $comment[$key]['reply'] = isset($comment[$key]['reply']) ? $comment[$key]['reply'] : array();
                $model->getParentName($comment[$key]['reply']);
            }
        }
        //最热的评论
        $mapHotComment['oid&status&cid'] = array($id, '1', $cid, '_multi' => true);
        $mapHotComment['agree'] = array('GT', 5);
        $hotComment = $model->where($mapHotComment)->order('agree DESC')->limit(10)->select();
        //获取是否还有评论没有显示出来，一级评论大于$maxShowComment
        if($commentCount > $maxShowComment)
            $this->assign('commentMore',1);
        $model->getParentName($hotComment);
        $this->assign('hotComment',$hotComment);
        $this->assign('commentList',$comment);//评论
        $this->assign('commentCount',$commentCount);
    }
    /**
     * 时间归类
     **/
    public function dateArc() {
        $cid = I('request.cid');
        $time = I('request.time');
        if(!empty($cid) && $cid != 0) //0表示所有文章归档
            $where['cid'] = array('in', D('Category')->getChild($cid)); //得到属于$cid的所有栏目的id
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
        $cid = I('post.cid');
        if(!empty($cid) || is_numeric($cid)) {
            $this->assign('articleAddList', D('Article')->getArticleList($cid));
            $this->display();
        }else{
            $this->error("参数错误！");
        }
    }
}
