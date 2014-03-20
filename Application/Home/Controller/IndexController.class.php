<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        $this->assign('articleList', D('Article')->getArticleList());
        $this->assign('articleCount',$this->getArticleCount());
        $this->assign('cid', 0);
        $this->assign('advertList', $advertList = $this->getAdvert());
        $this->assign('advertListCount', count($advertList));
        $this->assign('hotArticleList', $this->getHotArticleList());
        $this->seo('首页', NULL, NULL, NULL);
        //var_dump($this->getArticleList());
        $this->display();
    }
    private function getAdvert() {
        $where['status'] = 1;
        $list = M('Advert')->where($where)->order('sort DESC, createtime DESC')->select();
        return $list;
    }
}
