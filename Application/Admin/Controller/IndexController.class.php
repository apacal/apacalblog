<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Admin\Model\MenuModel;
use Think\Controller;
class IndexController extends CommonController {

    public function index($id = 0){
        $this->assign("delCacheUrl", U("System/delCache"));
        $Menu = new MenuModel();
        $menu = $Menu->getFirstMenu();
        if (0 != $id) {
            $this->assign("active_nav", "nav-$id");
        }
        $this->assign("user_info", getUserInfo());

        $subMenu = $Menu->getSubMenu($id);
        $this->assign('slide_data', json_encode($subMenu));
        $this->assign('first_menu', $menu);
        $this->display();
    }
}
