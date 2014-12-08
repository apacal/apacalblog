<?php
/**
 * 基础Controller
 **/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {


    /**
     * empty action redirect to 404
     */
    public function _empty() {
        redirect(C('FORBIDDEN'));
    }

    function _initialize(){
        $this->assign('navHtml',D('Category')->getNav());
        $this->assign('linkList', $this->getLink());
    }

    /**
     * @param $title
     * @param $keywords
     * @param $description
     * @param $position
     */
    public function seo($title,$keywords,$description,$position){
        $title = C('SITE_NAME'). " | $title";
        $this->assign('title',$title);
        $this->assign('keywords', $keywords.' | '.C('SITE_KEYWORDS'));
        $this->assign('description', $description.' | '.C('SITE_DESCRIPTION'));
        $this->assign('position',$position);
    }

    /**
     * @return array | false;
     */
    private function getLink() {
        $where['status'] = 1;
        $list = M('Link')->where($where)->order('sort DESC, createtime DESC')->select();
        return $list;
    }



}
