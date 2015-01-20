<?php
/**
 * 后台基础模型
 **/
namespace Admin\Model;
use Think\Model;
class CommonModel extends Model {
    protected $_validate = array(
        //array('status', 'require', '描述必须!'),
    );

    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', self::MODEL_BOTH, 'function'),
        array('uid', 'getAdminId', self::MODEL_BOTH, 'callback'),
    );

    /**
     * get Admin id from session
     * @return int
     */
    protected function getAdminId() {
        return is_login();
    }




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
            $list = $this->where($where)->order($order)->select();
        } else {

            $list = $this->where($where)->order($order)->limit($limit)->select();
        }

        return $list;
    }

}
