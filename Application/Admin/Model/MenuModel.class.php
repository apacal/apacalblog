<?php
namespace Admin\Model;
class MenuModel extends CommonModel{
    protected $_validate = array(
        array('name', 'require', '名字必须！'),

    );

    public function getFirstMenu() {
        $map = array(
            'pid'   => 0,
            'status' => 1,
        );
        $list = $this->where($map)->order("sort desc, id desc")->select();
        if (is_array($list)) {
            foreach($list as &$val) {
                $val['menuUrl'] = U('Index/index', array('id' => $val['id']));
            }
        }
        return $list;
    }

    public function getSubMenu($pid) {
        $map = array(
            'pid' => $pid,
        );
        $list = $this->where($map)->field("name, icon, url, id")->order("sort desc, id desc")->select();

        if (!empty($list)) {
            foreach($list as &$val) {
                $val['text'] = $val['name'];
                if (!empty($val['url'])) {
                    $val['a_attr'] = array(
                        'href' => U($val['url']),
                    );
                }
                $sub = $this->getSubMenu($val['id']);
                if (!empty($sub)) {
                    $val['children'] = $sub;
                    unset($val['icon']);
                }
            }
        }

        return $list;
    }

}

