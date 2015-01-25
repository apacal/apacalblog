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
        $tag = cacheTag(__METHOD__, $limit);
        if (false !== ($list = getCache($tag))) {
            return $list;
        }

        $where = array(
            'status' => 1,
        );
        $list = $this->where($where)->limit($limit)->order("sort DESC, createtime desc")->select();
        setCache($tag, $limit, LINK_TTL);
        return $list;
    }

} 