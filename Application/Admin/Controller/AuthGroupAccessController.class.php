<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-23
 * Time: 下午10:41
 */

namespace Admin\Controller;


use Admin\Model\AuthGroupModel;

class AuthGroupAccessController extends CommonController {
    public function setStatus() {
        header("HTTP/1.0 404 These data don't have status!");
    }


    protected function initEditAssign($pk, $controllerName, $type='Edit') {
        parent::initEditAssign('', $controllerName, $type);
    }
    /**
     * don't unset uid(parents do so)
     * @param $data
     */
    protected function unsetEditData(&$data) {
    }


    protected function setExtManageData(&$val) {
        parent::setExtManageData($val);
        $val['group_id'] = (new AuthGroupModel())->getGroupName($val['group_id']);

    }

} 