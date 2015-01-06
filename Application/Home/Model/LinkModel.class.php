<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-3
 * Time: 下午9:13
 */

namespace Home\Model;


use Think\Model;

class LinkModel extends Model{

    public function getLinkList($limit = 10) {

        $where = array(
            'status' => 1,
        );
        return $this->where($where)->limit($limit)->order("sort DESC, createtime desc")->select();
    }

} 