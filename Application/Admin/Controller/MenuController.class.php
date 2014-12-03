<?php
namespace Admin\Controller;
use Think\Controller;
class MenuController extends CommonController {

    public function _before_add() {
        parent::_before_add();
        $this->setMenuTree();
        $this->setAllModelList();
    }
    public function _before_edit() {
        $this->setMenuTree();
        $this->setAllModelList();
    }
    public function edit() {
        $model = D('Menu');
        $where['id'] = I('request.id');

        $vo = $model->where($where)->find();
        if(is_array($vo)) {
            $where['id'] = $vo['pid'];
            $vo['pname'] = $model->where($where)->getField('name');
        }

        $this->__edit($vo);
        $this->assign('vo', $vo);
        $this->display();
    }
    public function manage() {
        $menuId = I('request.menuId');
        $list = D('Menu')->getAllMenu();
        if (is_array($list)) {
            foreach ($list as &$val) {
                $val['url'] = $this->getEditUrl($val, $menuId);
            }
        }

        $this->assign('list', $list);
    }
}
