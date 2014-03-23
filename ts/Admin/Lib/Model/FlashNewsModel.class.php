<?php
/*
 * FlashNews模型类
 *
 * @author      Apacal
 * @时间        2013.05.02
 *
 */
class FlashNewsModel extends Model{
     protected $_validate=array(
        array('open','require','是否开放必须！'),
        array('position','require','位置必须!'),
    );
    protected $_auto=array(
        array('publish_time','time',1,'function'),
    );
    
}      
