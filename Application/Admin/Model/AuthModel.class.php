<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-24
 * Time: 上午1:50
 */

namespace Admin\Model;


class AuthModel extends CommonModel {
    public function checkAuth($rule, $uid) {
        if (false === ($ruleId = (new AuthRuleModel())->getruleId($rule))) {
            return true;
        }

        $groupIds = (new AuthGroupModel())->getGroupIdsByRuleId($ruleId);
        if ($groupIds === false) {
            return false;
        }

        if ((new AuthGroupAccessModel())->checkUserInGroups($uid, $groupIds) == true) {
            return true;
        } else {
            return false;
        }
    }

} 