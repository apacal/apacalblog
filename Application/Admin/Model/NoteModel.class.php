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

    protected $_validate = array(
        array('content','require','内容必须！'),
    );
}