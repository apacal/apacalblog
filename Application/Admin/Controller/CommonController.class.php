<?php
/**
 * 后台Controller基础类
 **/
namespace Admin\Controller;
use Admin\Model\CategoryModel;
use Admin\Model\UserModel;
use Think\Controller;
use Think\Model;

class CommonController extends Controller {


    protected $unManageField = array("updatetime");
    protected $controllerExtName = CONTROLLER_NAME;

    public function  _initialize() {
        if (!is_login()) {
            //$this->error("please login !", U("Home/User/login"));
        }
        if (!is_admin()) {
            //$this->error("you aren't admin!", U("Home/User/login"));
        }
    }

    public function delete() {
        $Model = new Model(CONTROLLER_NAME);
        $pk = $Model->getPk();
        $ret = array(
            'code' => '0',
            'data' => ''
        );
        if(isset($_REQUEST['id'])) {
            $map = array(
                $pk => $_REQUEST['id']
            );
        } else {
            $map = array(
                $pk => array('in', json_decode($_REQUEST['ids']))
            );
        }
        if (false === $Model->where($map)->delete()) {
        //if (false) {
            $ret['code'] = 1;
            $ret['data'] = $Model->getError();
            if(empty($ret['data'])) {
                $ret['data'] = $Model->getDbError();
            }
        }

        $this->jsonReturn($ret);
    }

    /**
     * must assign manage_fields and data_json
     */
    protected function setManageFields() {
        $Model = new Model(CONTROLLER_NAME);
        $fields = $Model->getDbFields();
        foreach($fields as &$val) {
            $name = $val;
            $val = array(
                'field' => $name,
                'name'  => $name,
            );
        }
        $fields = $this->unsetManageFields($fields, $this->unManageField);

        $this->assign("manage_fields", $fields);
        $this->assign("data_json_url", U(CONTROLLER_NAME .'/manageJsonData'));
    }

    /**
     * unset some not used field
     * @param $fields
     * @param $unsets
     * @return array
     */
    protected function unsetManageFields($fields, $unsets) {
        $newFields = array();
        foreach ($fields as $val) {
            if(!in_array($val['field'], $unsets)) {
                $newFields[] = $val;
            }
        }
        return $newFields;

    }

    public function setStatus() {
        $id = I('request.id');
        $status = I('request.status');
        $ret = array(
            'code' => 0,
            'data' => '',
        );

        $Model = new Model(CONTROLLER_NAME);
        $pk = $Model->getPk();
        if(empty($id)) {
            $where = array(
                $pk => array('in', json_decode($_REQUEST['ids']))
            );

        } else {
            if (empty($id) || !is_numeric($id)) {
                $ret['code'] = 1;
                $ret['data'] = "param error!";
                $this->jsonReturn($ret);
            }
            $where = array(
                $pk => $id,
            );
        }

        $data = array(
            'status' => 0,
        );
        if ($status === 'true') {
            $data['status'] = 1;
        }

        if (false === $Model->where($where)->save($data)) {
            $ret['code'] = 1;
            $ret['data'] = $Model->getError();
        }
        $this->jsonReturn($ret);

    }

    /**
     * return manage json data to manage table
     */
    public function manageJsonData() {
        $controllerName = CONTROLLER_NAME;
        $Model = new Model($controllerName);
        $list = $Model->field($this->unManageField, true)->select();
        $pk = $Model->getPk();
        foreach ($list as &$val) {
            $val['statusUrl'] = U($controllerName .'/setStatus');
            $val['editUrl'] = U($controllerName .'/edit', array('id' => $val[$pk]));
            $val['delUrl'] = U($controllerName .'/delete');
            $val['createtime'] = date("Y-m-d H:i:s", $val['createtime']);
            $val['pkey'] = $val[$pk];

            $val['editTab'] = $this->controllerExtName ."Edit";
            $val['id'] = $val[$pk];

            $this->setExtManageData($val);
        }

        $this->jsonReturn($list);
    }

    /**
     * common manage page
     */
    public function manage() {
        $this->setManageFields();
        $this->assign('delUrl', U(CONTROLLER_NAME .'/delete'));
        $this->assign('statusUrl', U(CONTROLLER_NAME .'/setStatus'));
        $this->display("Public:manageTable");
    }

    /**
     * edit page
     * @param $id
     */
    public function edit($id) {
        $controllerName = CONTROLLER_NAME;
        $Model = new Model($controllerName);
        if (empty($id) || !is_numeric($id)) {
            exit("param error!");
        }
        $pk = $Model->getPk();
        $this->initEditAssign($pk, $controllerName);

        $map = array(
            $pk => $id,
        );
        $data = $Model->where($map)->find();
        $this->unsetEditData($data);
        $this->assign('data', $data);

        $this->display('Public/edit');

    }

    public function add() {
        $controllerName = CONTROLLER_NAME;
        $Model = new Model($controllerName);
        $pk = $Model->getPk();
        $this->initEditAssign($pk, $controllerName, 'Add');
        $fields = $Model->getDbFields();
        $data = array();
        foreach($fields as $val) {
            $data[$val] = '';
        }
        $this->unsetEditData($data);
        $this->assign('data', $data);
        $this->display('Public/edit');

    }


    /**
     * update or insert data
     */
    public function save() {
        $Model = D(CONTROLLER_NAME);
        $pk = $Model->getPk();

        if (empty($_REQUEST[$pk])) {
            $data = $Model->create($_POST, MODEL::MODEL_INSERT);
            unset($data[$pk]);
            $result = $Model->add($data);

        } else {
            $data = $Model->create($_POST, MODEL::MODEL_UPDATE);
            $map = array(
                $pk => $data[$pk]
            );
            unset($data[$pk]);
            $result = $Model->where($map)->save($data);
        }


        if ($result) {
            $ret = array(
                'code' => 0,
                'data' => '',
            );
        } else {
            $ret = array(
                'code' => 1,
                'data' => $Model->getError()
            );
            if (empty($ret['data'])) {
                $ret['data'] = $Model->getDbError();
            }
        }

        $this->jsonReturn($ret);

    }

    /**
     * assign some var to edit page
     * @param $pk
     * @param $controllerName
     * @param $type
     */
    protected function initEditAssign($pk, $controllerName, $type='Edit') {
        $this->assign('pk', $pk);
        $this->assign('formAction', U($controllerName .'/save'));
        $this->assign('addUrl', U($controllerName .'/add'));
        $this->assign('time', time());
        $this->assign('title', $this->controllerExtName .$type);
        $this->assign('addTabName', $this->controllerExtName .'Add');
    }

    /**
     * unset some var that don't need to edit
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

        unset($data['createtime'], $data['updatetime'], $data['uid']);
    }

    protected function setExtManageData(&$val) {
        if (isset($val['image'])) {
            $val['image'] = '<img style="width:40px;height:40px" src="' .$val['image'] .'"></img>';
        }
        if (isset($val['cid'])) {
            $val['cid'] = (new CategoryModel())->getCategoryName($val['cid']);
        }
        if (isset($val['uid'])) {
            $val['uid'] = (new UserModel())->getUserName($val['uid']);
        }
    }





}
