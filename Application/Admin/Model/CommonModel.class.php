<?php
/**
 * 后台基础模型
 **/
namespace Admin\Model;
use Think\Model;
class CommonModel extends Model {
    protected $_auto = array( //自动完成
        array('is_check', '1', 1),
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', 3, 'function'),
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
