<?php
namespace Home\Controller;
use Think\Controller;
class NoteController extends CommonController {
    
    public function index() {
        $this->seo('闲言杂语', NULL, NULL, NULL);
        $sql = "select id, ablg_note.createtime as time,content,adminname,image from ablg_note left join ablg_admin on ablg_note.adminid=ablg_admin.adminid order by time desc";
        $Model = new \Think\Model();
        $list = $Model->query($sql);
        $this->assign('list', $list);
        $this->display();
    }

}
