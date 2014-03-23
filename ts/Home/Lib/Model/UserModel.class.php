<?php
/*
 * Admin模型类
 *
 * @author      Apacal
 * @时间        2013.05.02
 *
 */
class UserModel extends Model{
    protected $_validate=array(
        array('name','require','名字必须!',2),
        array('name','','帐号名称已经存在！',0,'unique',1), 
        array('user_name','require','名字必须!',2),
        array('password','require','密码必须!'),
        array('repassword','password','确认密码不正确',0,'confirm'),
        array('email','require','邮箱必须'),
        array('email','email','邮箱格式不对'),
    );
    protected $_auto=array(
        array('password','md5',Model::MODEL_BOTH,'function') ,
    );
}     
