<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-12-3
 * Time: 下午3:10
 */
namespace Admin\Model;
use Think\Model;
class NoteModel extends CommonModel {
    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', 3, 'function'),
        array('adminid', 'getAdminId', 3, 'callback'),
    );

    protected $_validate = array(
        array('content','require','内容必须！'),
    );
}