<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-5-30
 * Time: 下午6:38
 */

namespace Home\Model;


class BookModel extends CommonModel {
    public function getList() {
        $tag = cacheTag(__METHOD__);
        $list = getCache($tag);
        if ($list === false) {
            $where = array(
                'status' => 1,
            );
            $list = $this->where($where)->order("sort desc, id desc")->select();
            setCache($tag, $list, BOOK_TTL);
        }

        return $list;
    }

} 