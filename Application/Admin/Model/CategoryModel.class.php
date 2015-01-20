<?php
/**
 * 栏目模型
 **/
namespace Admin\Model;
use Think\Model;
class CategoryModel extends CommonModel {
    protected $_validate = array(
        array('title','require','标题必须！'),
        array('sort','require','排序值必须！'),
        array('image','require','图片必须！'),


    );
    public function getCategoryName($cid) {
        $where = array(
            'id' => $cid
        );
        return $this->where($where)->getField('cname');
    }


    public function getAllCategory() {
        $map['pid'] = 0;
        if ( $list = $this->where($map)->order('sort DESC')->select() ) {
            return $this->getCategorySub( $list );
        } else {
            return false;
        }

    }
    private function getCategorySub( $list ) {
        $allCategory = array();
        foreach($list as $val) {
            $allCategory[] = $val;
            $map['pid'] = $val['id'];
            $sub = $this->where($map)->order("sort DESC")->select();
            if (!empty($sub) && is_array($sub)) {
                $sub = $this->getCategorySub($sub);
                foreach($sub as $value) {
                    $allCategory[] = $value;
                }
            }
        }
        return $allCategory;
    }
}
