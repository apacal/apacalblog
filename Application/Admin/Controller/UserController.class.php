<?php
namespace Admin\Controller;
use Admin\Model\UserModel;
use Think\Controller;
use Think\Model;

class UserController extends CommonController {
    protected $order = 'uid desc';

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

    public function createPwd($password, $repassword) {
        $ret = array(
            'code' => 0,
            'data' => '',
        );

        if (empty($password)) {
            $ret['code'] = 1;
            $ret['data'] = "password can't not be empty!";
            $this->jsonReturn($ret);
        }

        if ($password !== $repassword) {
            $ret['code'] = 1;
            $ret['data'] = 'retype password is not correct!';
            $this->jsonReturn($ret);
        }

        $ret['data'] = createHash($password);
        $this->jsonReturn($ret);

    }

    /**
     * don't assign uid to name(in parents)
     * @param &$val
     */
    protected function setExtManageData(&$val) {}


    public function treeJson() {
        $Model = new UserModel();
        $treeData = $Model->getUserTreeData();
        echo(json_encode($treeData));

    }

}

