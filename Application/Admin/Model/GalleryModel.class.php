<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-4-18
 * Time: 上午10:13
 */

namespace Admin\Model;


class GalleryModel extends CommentModel {


    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', self::MODEL_BOTH, 'function'),
        array('uid', 'getAdminId', self::MODEL_BOTH, 'callback'),
    );

} 