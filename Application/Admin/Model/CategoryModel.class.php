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

    public function getCateTreeData($pid) {
        $map = array(
            'pid' => $pid,
            'status' => 1,
        );
        $list = $this->where($map)->field("cname, id")->order("sort desc, id desc")->select();

        if (!empty($list)) {
            foreach($list as &$val) {
                $val['text'] = $val['cname'];
                $val['a_attr'] = array(
                    'onclick' => "addValueToInput('" .$val['id'] ."');",
                );
                $sub = $this->getCateTreeData($val['id']);
                if (!empty($sub)) {
                    $val['children'] = $sub;
                }
            }
        }

        return $list;
    }

}
