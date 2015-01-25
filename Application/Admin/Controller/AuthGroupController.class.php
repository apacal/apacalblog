<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-23
 * Time: 下午10:40
 */

namespace Admin\Controller;


use Admin\Model\AuthGroupModel;

class AuthGroupController extends CommonController {

    public function setStatus() {
        header("HTTP/1.0 404 These data don't have status!");
    }

    public function setExtManageData(&$val) {
        parent::setExtManageData($val);
        $rules = json_decode($val['rules']);
        if (count($rules) >= 10) {
            $rules = array_splice($rules, 0, 10);
            $rules[] = '......';
            $val['rules'] = json_encode($rules);
        }
    }

    public function treeJson() {
        $Model = new AuthGroupModel();
        $treeData = $Model->getGroupTreeData();
        echo(json_encode($treeData));

    }
}
