<?php
/**
 * 基础Controller
 **/
namespace Home\Controller;
use Home\Model\CategoryModel;
use Think\Controller;
use Think\Model;

class CommonController extends Controller {


    /**
     * empty action redirect to 404
     */
    public function _empty() {
        var_dump(CONTROLLER_NAME);
        //redirect(C('FORBIDDEN'));
    }

    protected function jsonReturn($data) {
        die(json_encode($data));
    }

    function _initialize(){
        $userInfo = getUserInfo();
        if (($uid = is_login()) > 0) {
            $this->assign('uid', $uid);
            $userInfo['url'] = U('user/' .$uid .C('URL_HASH'));
        }

        $userInfo = getUserInfo();
        $this->assign('nav_html',(new CategoryModel())->getNav());
        $this->assign('link_list', $this->getLink());
        $this->assign('userInfo', $userInfo);
        if (isset($userInfo['uid'])) {
            $this->assign('uid', $userInfo['uid']);
        }
    }

    /**
     * @param $title
     * @param $keywords
     * @param $description
     */
    public function seo($title,$keywords,$description){
        $title = C('SITE_NAME'). " | $title";
        $this->assign('title',$title);
        $this->assign('keywords', $keywords.' | '.C('SITE_KEYWORDS'));
        $this->assign('description', $description.' | '.C('SITE_DESCRIPTION'));
    }

    /**
     * @return array | false;
     */
    private function getLink() {
        $where['status'] = 1;
        $list = (new Model('Link'))->where($where)->order('sort DESC, createtime DESC')->select();
        return $list;
    }



}
