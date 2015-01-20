<?php
namespace Admin\Model;
class MenuModel extends CommonModel{
    protected $_validate = array(
        array('name', 'require', '名字必须！'),

    );

    /**
     * get menu data on nav-bar
     * @return mixed | false | null
     * @author apacal
     */
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

    /**
     * get sub menu on this id
     * @param $pid
     * @return mixed
     * @author apacal
     */
    public function getSubMenu($pid) {
        $map = array(
            'pid' => $pid,
            'status' => 1,
        );
        $list = $this->where($map)->field("name, icon, url, id")->order("sort desc, id desc")->select();

        if (!empty($list)) {
            foreach($list as &$val) {
                $val['text'] = $val['name'];
                if (!empty($val['url'])) {
                    $val['a_attr'] = array(
                        'onclick' => "addTab('" .$val['name'] ."', '" .U($val['url']) ."');",
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

