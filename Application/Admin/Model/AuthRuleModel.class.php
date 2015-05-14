<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-24
 * Time: 上午12:49
 */

namespace Admin\Model;



class AuthRuleModel extends CommonModel {
    public function getRuleId($rule) {
        $id = $this->where(array('rule'=>$rule))->getField('id');
        if (empty($id)) {
            return false;
        } else {
            return $id;
        }
    }
    public function getRuleTreeData($groupId) {


        $list = $this->field("name,rule, id")->order('rule, name')->select();

        if (!empty($list)) {
            if (!empty($groupId)) {
                $groupRuleIds = (new AuthGroupModel())->getGroupRuleIds($groupId);
            }
            foreach($list as &$val) {
                $val['text'] = $val['name'] .'--[' .$val['rule'] .']';
                if (empty($groupId) || empty($groupRuleIds)) {
                    continue;
                }
                if (in_array($val['id'] ,$groupRuleIds)) {
                    $val['state'] = array(
                        'selected' => true,
                    );
                }
            }
        }


        return $list;
    }

} 