<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CommonRelationModel extends RelationModel {

    protected $_auto = array( //自动完成
        array('is_check', '1', 1),
        //array('status', '1'), //默认不需要审核
        array('createtime', 'time', 1, 'function'),
        array('updatetime', 'time', 2, 'function'),
        array('adminid', 'getAdminId', 3, 'callback'),
    );
    /**
     * 获取管理员id
     **/
    protected function getAdminId() {
        $adminid = $_SESSION['adminid'];
        if($adminid)
            return $adminid;
        return 1;
    }
    protected $_validate = array(
        array('description', 'require', '描述必须!'),
    );
}
