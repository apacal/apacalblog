<?php
/**
 *  闲言杂语控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class NoteController extends CommonController {
    public function insert() {
        $model = M('Note');
        if (empty($_REQUEST['description'])) {
            $this->error('content is miss!');
        }
        $data['content'] = $_REQUEST['description'];
        $data['createtime'] = time();
        $data['adminid'] = $_SESSION['adminid'];
        if (!$model->add($data)) {
            $this->error($model->getError());
        } else {

            deleteCache(cacheTag(NoteList));
            $this->success("添加成功!");
        }
    }

}
