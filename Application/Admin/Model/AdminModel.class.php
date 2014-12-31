<?php
/**
 * Admin模型
 **/
namespace Admin\Model;
use Think\Model;
class AdminModel extends CommonModel {
    protected $_validate = array(
        array('adminname','require','名字必须！'),
        array('email','require','邮箱必须！'),
        array('adminname','','帐号名称已经存在！',0,'unique',1),
        array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
    );


    public function insert($data) {
        $data['pwd'] = createHash($data['password']);
        if (($uid = $this->add($data)) === false) {
            return false;
        } else {
            return $uid;
        }

    }


}

