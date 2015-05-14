<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-4-19
 * Time: 下午10:41
 */

namespace Home\Model;


class GalleryModel extends CommonModel{
    public function getListByWhere($where) {
        $list = $this->where($where)->select();
        if (is_array($list)) {
            foreach($list as &$val) {
                $val['url'] = U('Gallery/view'.C('URL_HASH'), array('id' => $val['id'], 'title' => $val['title']));
            }
        }

        return $list;
    }

} 