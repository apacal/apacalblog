<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends CommonModel {
    protected $_validate = array(
        array('name','require','名字必须！'),
        array('email','require','邮箱必须！'),
        array('name','','帐号名称已经存在！',Model::EXISTS_VALIDATE,'unique',Model::MODEL_INSERT),
    );




    public function checkUserExit($uid, $name) {
        $exitUid = $this->where(array('name' => $name))->getField('uid');
        if ($uid === $exitUid) {
            return false;
        } else {
            return true;
        }
    }


    public function update($uid, $data) {
        $where = array(
            'uid' => $uid,
        );

        return $this->where($where)->save($data);
    }

    /**
     * @param $uid
     * @return array | false
     */
    public function getUserInfo($uid) {
        $where = array(
            'uid' => $uid,
        );
        return $this->where($where)->find();
    }

    public function getUserName($uid) {
        $where = array(
            'uid' => $uid
        );
        return $this->where($where)->getField('name');
    }

    public function insert($data) {
        if (($uid = $this->add($data)) === false) {
            return false;
        } else {
            return $uid;
        }

    }


}

