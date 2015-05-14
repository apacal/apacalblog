<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-23
 * Time: 下午11:42
 */

namespace Admin\Model;



class AuthGroupModel extends CommonModel {

    public function getGroupName($id) {
        return $this->where(array('id'=>$id))->getField('name');

    }

    public function getGroupIdsByRuleId($ruleId){
        $where = array(
            'rules' => array('like', '%"' .$ruleId .'"%'),
        );
        $list = $this->where($where)->field("id")->select();
        if (is_array($list)) {
            $ids = array();
            foreach($list as $val) {
                $ids[] = $val['id'];
            }
            return $ids;
        } else {
            return false;
        }
    }
    /**
     * json_encode rules;
     * @param $data
     */
    protected function proSaveData(&$data) {
        $data['rules'] = json_encode($data['rules']);
    }

    public function getGroupRuleIds($id) {
        $rules  = $this->where(array('id'=>$id))->getField(('rules'));
        if (!empty($rules)) {
            return json_decode($rules);
        } else {
            return array();
        }

    }

    public function getGroupTreeData() {
        $list = $this->field("name, id")->select();

        if (!empty($list)) {
            foreach($list as &$val) {
                $val['text'] = $val['name'];
                $val['a_attr'] = array(
                    'onclick' => "addValueToInput('" .$val['id'] ."');",
                );
            }
        }

        return $list;
    }
} 