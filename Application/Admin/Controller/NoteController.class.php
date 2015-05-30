<?php
namespace Admin\Controller;
use Think\Controller;
class NoteController extends CommonController {
    protected $unManageField = array("updatetime",'uid');

    protected function unsetEditData(&$data) {
        parent::unsetEditData($data);
        if (isset($data['pid']) && empty($data['pid'])) {
            $data['pid'] = 0;
        }
        if (isset($data['cid']) && empty($data['cid'])) {
            $data['cid'] = 9;
        }
    }

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
