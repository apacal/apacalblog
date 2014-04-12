<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CategoryModel extends RelationModel {

    protected $_link = array(
        'Model' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Model',
            'foreign_key' => 'mid',
            'mapping_fields' => 'mcontroller',
            'as_fields' => 'mcontroller',
        ),
    );
    public function getPosition($cid, &$position) {
        $cate = $this->where(array('id' => $cid))->find();
        $cate['url'] = U('category/'.$cate['id']);
        $position[] = $cate;
        while($cate['pid'] != 0) {
            $cate = $this->where(array('id' => $cate['pid']))->find();
            $cate['url'] = U('category/'.$cate['id']);
            $position [] = $cate;
        }
        $new = array();
        while($position) {
            $new[] = array_pop($position);
        }
        $position = $new;

    }
    /**
     * 获得栏目菜单
     **/
    public function getNav() {
        $where['status'] = 1;
        $where['pid'] = 0;
        $list = $this->where($where)->order('sort DESC')->relation(true)->select();
        $this->getSubNav($list);
        return $list;
    }
    /**
     * 用于获取每个栏目下的栏目，
     * @param &$list
     **/
    private function getSubNav(&$list) {
        foreach($list as &$value) {
            $where['status'] = 1;
            $where['pid'] = $value['id'];
            $value['url'] = U('category/'.$value['id']);
            if(($subNav = $this->where($where)->order('sort DESC')->relation(true)->select())) {
                $value['subNav'] = $subNav;
                $this->getSubNav($value['subNav']);
            }
        }
    }
    /**
     * 获取当前category的下属栏目
     * @param $id 
     **/
    public function getChild($id) {
        $result = array();
        $this->getChildren($result, $id);
        $list = array();
        // 处理查询结果
        foreach ($result as $value)
            $list[] = (int)$value;
        //print_r($list);
        return $list;
    }
    /**
     * 获取$cid 的下属栏目id，内部使用
     * @param &$result, $id
     **/
    private function getChildren(&$result, $id) {
        $result[] = $id; //将当前的cid压入
        $where['status'] = 1;
        $where['pid'] = $id;
        $list = $this->where($where)->getField('id', true);
        $result = array_merge((array)$result, (array)$list);
    }
}
?>

