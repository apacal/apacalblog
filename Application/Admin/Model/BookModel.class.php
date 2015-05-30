<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-5-30
 * Time: 下午6:27
 */

namespace Admin\Model;


class BookModel extends CommonModel {
    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', self::MODEL_BOTH, 'function'),
        array('uid', 'getAdminId', self::MODEL_BOTH, 'callback'),
    );
} 