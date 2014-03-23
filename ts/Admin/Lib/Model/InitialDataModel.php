<?php
/*
 * InitialData模型类
 *
 * @author      Apacal
 * @时间        2013.05.02
 *
 */
class InitialDataModel extends Model{
    protected $_validate=array(
        array('title','require','文章标题必须!'),
        array('content','require','内容必须!'),
    );
    protected $_auto=array(
        array('publish_time','time',1,'function'),
    );
}     
