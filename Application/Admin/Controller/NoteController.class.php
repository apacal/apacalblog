<?php
/**
 *  闲言杂语控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class NoteController extends CommonController {
    protected $unManageField = array("updatetime",'uid');

    protected function setExtManageData(&$val) {
        parent::setExtManageData($val);
        $subLen = 40;
        $val['content'] = strip_tags($val['content']);
        $len = mb_strlen($val['content'],'utf8');
        $val['content'] = mb_substr($val['content'], 0, $subLen, 'utf8');
        if ($len > $subLen) {
            $val['content'] .= " ......";
        }
    }

}
