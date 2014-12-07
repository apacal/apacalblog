<?php
/**
 * 后台基础模型
 **/
namespace Admin\Model;
use Think\Model;
class CommonModel extends Model {
    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', self::MODEL_BOTH, 'function'),
        array('adminid', 'getAdminId', self::MODEL_BOTH, 'callback'),
    );

    /**
     * get Admin id from session
     * @return int
     */
    protected function getAdminId() {
        if(isset($_SESSION['adminid'])) {
            return $_SESSION['adminid'];
        } else {
            return false;
        }
    }

    protected $_validate = array(
        array('description', 'require', '描述必须!'),
    );

    protected $order = 'updatetime desc';

    protected $where = array();


    /**
     * get data list
     * @param array $where
     * @param string $order
     * @param string $limit
     * @return array | false
     */
    public function getList($where = array(), $order = '', $limit = '') {
        if(empty($where)) {
            $where = $this->where;
        }
        if (empty($order)) {
            $order = $this->order;
        }

        if (empty($limit)) {
            $list = $this->where($where)->order($order)->slecet();
        } else {

            $list = $this->where($where)->order($order)->limit($limit)->slecet();
        }

        return $list;
    }

}
