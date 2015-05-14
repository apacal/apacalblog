<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-12-25
 * Time: 下午11:15
 */

namespace Home\Model;


class SearchModel {
    public function getSearchList($content) {
        $tag = cacheTag(__METHOD__, $content);
        if (false !== ($list = getCache($tag))) {
            return $list;
        }
        $searchTable = C('SEARCH_TABLE'); //需要查询的表
        $searchCol = C('SEARCH_COL');
        $searchSetCol = C('SEARCH_SET_COL');
        $result = array();
        foreach($searchTable as $val) {
            $model = D($val);
            $where = array();
            foreach($searchCol as $value) {
                $where[$value] = array('like', '%'.$content.'%');
            }
            $where['_logic'] = 'OR';

            $list = $model->getListByWhere($where);
            $result = array_merge($result, $list);
        }


        if (!is_array($result) || count($result) == 0) {
            return false;
        }

        $replace = "<code>$content</code>";
        foreach($result as &$val) {
            foreach($searchSetCol as $value) {
                $val[$value] = str_replace($content, $replace, $val[$value]);
            }
        }
        setCache($tag, $result, SEARCH_TTL);
        return $result;
    }

} 