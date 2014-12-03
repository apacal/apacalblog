<?php
/**
 * 基础Controller
 **/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {




    public function _empty() {
   //     var_dump(C('FORBIDDEN'));
      //  echo __ACTION__;
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
        $title = C('SITE_NAME'). " | $title";
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



}
