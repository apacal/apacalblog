<?php
/**
 * 基础Controller
 **/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _empty() {
   //     var_dump(C('FORBIDDEN'));
       redirect(C('FORBIDDEN'));
    }

    /**
     *  初始化
     **/
    function _initialize(){
        $this->assign('navList',D('Category')->getNav());
        $this->assign('linkList', $this->getLink());
    }
    /**
     * seo 设置标题，关键字，描述，位置
     **/
    public function seo($title,$keywords,$description,$position){
        $title = C('SITE_ROOT_NAME').$title;
        $this->assign('title',$title);
        $this->assign('keywords', $keywords.' | '.C('SITE_KEYWORDS'));
        $this->assign('description', $description.' | '.C('SITE_DESCRIPTION'));
        $this->assign('position',$position);
    }
    /**
     * 获得友情链接
     **/
    private function getLink() {
        $where['status'] = 1;
        $list = M('Link')->where($where)->order('sort DESC, createtime DESC')->select();
        return $list;
    }

    /**
     * 获得热门文章
     * @param $cid = 0, $limit = 18
     **/
    protected function getHotArticleList($cid = 0, $order='sort DESC, id DESC', $limit = 18) {
        $where['status'] = 1;
        if($cid != 0)
            $where['cid'] = array('in', D('Category')->getChild($cid)); //得到属于$cid的所有栏目的id
        $list = D('Article')->where($where)->relation(true)->order($order)->limit($limit)->select();
        $this->assign('hotArticleCount', count($list));
        return $list;
    }

    public function getRandArticleList($cid = 0, $order='sort DESC, id DESC', $limit = 18) {
        $where['status'] = 1;
        if($cid != 0)
            $where['cid'] = array('in', D('Category')->getChild($cid)); //得到属于$cid的所有栏目的id
        $list = D('Article')->where($where)->relation(true)->order($order)->limit($limit)->select();
        $this->assign('hotArticleCount', count($list));
        return $list;
    }

    /**
     * 获得文章数目
     * @param $cid
     **/
    protected function getArticleCount($cid = 0) {
        $where['status'] = 1;
        if($cid != 0)
            $where['cid'] = array('in', D('Category')->getChild($cid)); //得到属于$cid的所有栏目的id
        return (M('Article')->where($where)->count());
    }

}
