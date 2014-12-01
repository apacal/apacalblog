<?php
namespace Admin\Controller;
use Think\Controller;
class ModelController extends CommonController {

    public function _before_add() {
        $this->setAllModelList();
    }
    public function _before_edit() {
        $this->setAllModelList();
    }
}
