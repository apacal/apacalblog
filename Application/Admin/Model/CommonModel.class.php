<?php
/**
 * 后台基础模型
 **/
namespace Admin\Model;
use Think\Model;
class CommonModel extends Model {
    protected $_validate = array(
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

    public function insert($data) {
        if (($id = $this->add($data))) {
            return $id;
        } else {
            return $this->getError() .' | ' .$this->getDbError();
        }
    }

    public function update($where, $data) {

        if ($this->where($where)->save($data) === false) {

            return $this->getError() .' | ' .$this->getDbError();

        } else {

            return true;
        }

    }





}
