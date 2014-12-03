<?php
/**
 *  闲言杂语控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class NoteController extends CommonController {
    protected $manageSort = "createtime DESC";
    public function _atfer_insert() {

        deleteCache(cacheTag(NoteList));
    }

    public function _atfer_update() {

        deleteCache(cacheTag(NoteList));
    }


}
