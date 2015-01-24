<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-23
 * Time: 下午11:41
 */

namespace Admin\Model;


use Think\Model;

class AuthGroupAccessModel extends Model{
    public function checkUserInGroups($uid, $groupIds) {
        $where = array(
            'uid' => $uid,
            'group_id' => array('in', $groupIds)
        );

        $count = $this->where($where)->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserGroupByUid($uid) {
        return $this->where(array('uid'=>$uid))->count();
    }


} 