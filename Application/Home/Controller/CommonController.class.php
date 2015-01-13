<?php
/**
 * 基础Controller
 **/
namespace Home\Controller;
use Admin\Model\UserModel;
use Home\Model\CategoryModel;
use Home\Model\LinkModel;
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
            $User = new UserModel();
            $userInfo = $User->getUserInfo($uid);
            $this->assign('userInfo', $userInfo);
        }

        $this->assign('nav_html',(new CategoryModel())->getNav());
        $this->assign('link_list', (new LinkModel())->getLinkList(10));
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


}
