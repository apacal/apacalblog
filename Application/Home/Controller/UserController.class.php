<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-12-30
 * Time: 下午3:02
 */

namespace Home\Controller;


use Admin\Model\AdminModel;

class UserController extends CommonController{
    public function view() {
        $this->success("正在完善！");
    }

    public function index() {
        $uid = is_login();
        if ($uid <= 0) {
            $this->error("想要登陆！");
        }

        $Admin = new AdminModel();

    }

    public function register() {
        $url = "http://area.sinaapp.com/bingImg?daysAgo=";
        $url .= rand(0, 14);
        $this->assign('background_url', $url);
        $this->display();

    }

    public function add() {
        $model= new AdminModel();
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }

        $uid = $model->insert($data);
        if (!empty($uid)) {
            setUserLogin($uid);
            setUserInfoByAdminLogin($data);
            $this->success('注册成功！', U('User/index'));
        } else {
            $this->error("注册失败！");
        }
    }
} 