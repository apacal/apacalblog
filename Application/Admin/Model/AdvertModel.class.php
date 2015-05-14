<?php
/**
 * 广告模型
 **/
namespace Admin\Model;
use Think\Model;
class AdvertModel extends CommonModel {
    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', self::MODEL_BOTH, 'function'),
        array('uid', 'getAdminId', self::MODEL_BOTH, 'callback'),
    );

    protected $_validate = array(
        array('title','require','标题必须！'),
        array('description','require','描述必须！'),
        array('sort','require','排序值必须！'),
        array('image','require','图片必须！'),
    );
}
