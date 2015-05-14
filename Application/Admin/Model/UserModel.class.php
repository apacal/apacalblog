<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends CommonModel {
    protected $_validate = array(
        array('name','require','名字必须！'),
        array('email','require','邮箱必须！'),
        array('name','','帐号名称已经存在！',Model::EXISTS_VALIDATE,'unique',Model::MODEL_INSERT),
    );

    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', self::MODEL_BOTH, 'function'),
    );


    public function getUserInfoByName($name) {
        $where = array(
            'name' => $name
        );

        $userInfo = $this->where($where)->find();
        if (is_array($userInfo)) {
              $userInfo['isGroup'] =  (new AuthGroupAccessModel())->getUserGroupByUid($userInfo['uid']);
        }
        return $userInfo;
    }

    public function checkUserExit($uid, $name) {
        $exitUid = $this->where(array('name' => $name))->getField('uid');
        if ($uid === $exitUid) {
            return false;
        } else {
            return true;
        }
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


    public function getUserTreeData() {
        $map = array(
            'status' => 1,
        );
        $list = $this->where($map)->field("name, uid")->select();

        if (!empty($list)) {
            foreach($list as &$val) {
                $val['text'] = $val['name'];
                $val['a_attr'] = array(
                    'onclick' => "addValueToInput('" .$val['uid'] ."');",
                );
            }
        }

        return $list;
    }


}

