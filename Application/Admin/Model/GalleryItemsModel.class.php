<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-4-19
 * Time: 上午11:17
 */

namespace Admin\Model;


class GalleryItemsModel extends CommonModel {

    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', self::MODEL_BOTH, 'function'),
        array('uid', 'getAdminId', self::MODEL_BOTH, 'callback'),
    );
}