<?php
/**
 * Link模型
 **/
namespace Admin\Model;
use Think\Model;
class LinkModel extends CommonModel {
    protected $_validate = array(
        array('title','require','标题必须！'),
        array('description','require','描述必须！'),
        array('sort','require','排序值必须！'),
    );
}
