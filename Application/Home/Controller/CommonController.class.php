<?php
/**
 * 基础Controller
 **/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _empty() {
        $admin = C('WEBADMIN');
        $this->error("操作失败，请联系管理员".$admin,U('Home/Index/index'), 1);
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
        $this->assign('keywords',C('SITE_KEYWORDS').$keywords);
        $this->assign('description',C('SITE_DESCRIPTION').$description);
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
    public function getHotArticleList($cid = 0, $limit = 18) {
        $where['status'] = 1;
        if($cid != 0)
            $where['cid'] = array('in', D('Category')->getChild($cid)); //得到属于$cid的所有栏目的id
        $list = D('Article')->where($where)->relation(true)->order('click DESC')->limit($limit)->select();
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
