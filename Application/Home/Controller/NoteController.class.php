<?php
namespace Home\Controller;
use Think\Controller;
class NoteController extends CommonController {
    
    public function index() {
        $this->seo('闲言杂语', NULL, NULL, NULL);

        $model = D('Note');
        $list = $model->getNoteList();
        $this->assign('list', $list);
        $this->display();
    }

}
