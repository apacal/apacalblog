<?php
/**
 * Admin控制器
 **/
namespace Admin\Controller;
use Think\Controller;
use Think\Model;

class UserController extends CommonController {

    protected $unManageField = array("updatetime", "pwd",'logintime');
    /**
     * unset some var that don't need to edit, diff from CommonController unset uid
     * @param &$data
     */
    protected function unsetEditData(&$data) {
        $ext = array(
        );
        if (isset($data['createtime'])) {
            $ext['createtime'] = $data['createtime'];
        }

        if (isset($data['updatetime'])) {
            $ext['updatetime'] = $data['updatetime'];
        }
        $this->assign("ext", $ext);

        unset($data['createtime'], $data['updatetime'], $data['loginip'],$data['logintime']);
    }
}

