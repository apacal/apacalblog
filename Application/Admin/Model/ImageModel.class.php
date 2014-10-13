<?php
/**
 * Image模型
 **/
namespace Admin\Model;
use Think\Model;
class ImageModel extends CommonModel {
    protected $_validate = array(
        array('title','require','标题必须！'),
    );
}
