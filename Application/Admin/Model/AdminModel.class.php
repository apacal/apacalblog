<?php
/**
 * Admin模型
 **/
namespace Admin\Model;
use Think\Model;
class AdminModel extends CommonModel {
    protected $_validate = array(
        array('adminname','require','名字必须！'),
        array('description','require','描述必须！'),
        array('email','require','邮箱必须！'),
        array('image','require','图片必须！'),
        array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
    );
}

