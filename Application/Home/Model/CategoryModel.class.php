<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class CategoryModel extends RelationModel {


    /**
     * @param $cid
     * @param $oid
     * @return array | array('cate' => $cata, 'data' => $data)
     */
    public function getExtendInfoByCategoryIdAndObjectId($cid, $oid) {
        $tag = cacheTag(__METHOD__, $cid, $oid);
        if (false !== ($data = getCache($tag))) {
            return $data;
        }
        $cate = $this->where(array('id'=>$cid))->find();
        if (empty($cate)) {
            return false;
        }
        $modelName = explode('/', $cate['url'])[0];
        if ($modelName == 'Note' || empty($modelName)) {
            $origin = false;
        } else {
            $origin = (new Model($modelName))->where(array('id'=>$oid, 'cid' => $cid))->field('title')->find();
        }
        if(empty($origin)) {
            $origin = false;
        }
        $data = array('origin' => $origin, 'cate' => $cate);
        setCache($tag, $data, CATEGORY_TTL);
        return $data;
    }

    /**
     * @param $cid | int
     * @return array|false
     */
    public function getRedirectUrlByCategory($cid, $page) {
        $tag = cacheTag(__METHOD__, $cid, $page);
        if (false !== ($url = getCache($tag))) {
            return $url;
        }
        $url = $this->where(array('id' => $cid))->getField('url');
        if (strpos($url, ".html") === false) {
            $url = U($url, array('cid' => $cid));
        }

        setCache($tag, $url, CATEGORY_TTL);
        return $url;
    }

    /**
     * get nav menu
     * @return array|false
     */
    public function getNav() {
        $tagNav = cacheTag(__METHOD__);
        if (false !== ($html = getCache($tagNav))) {
            return $html;
        }
        $where['status'] = 1;
        $where['pid'] = 0;
        $list = $this->where($where)->order('sort DESC')->select();
        $this->getSubNav($list);

        if (false !== ($html = $this->getNavHtml($list, 1))) {
            setCache($tagNav, $html, CATEGORY_TTL);
            return $html;
        } else {
            return false;
        }

    }
    /**
     * @param $id
     * @return array | false
     */
    public function getThisCategoryChildren($id) {
        $tagChildren = cacheTag(__METHOD__, $id);
        if (false === ($list = getCache($tagChildren))) {
            $result = array();
            $result[] = $id; //将当前的cid压入
            $where['status'] = 1;
            $where['pid'] = $id;
            $list = $this->where($where)->getField('id', true);
            $result = array_merge((array)$result, (array)$list);

            $list = array();
            // 处理查询结果
            foreach ($result as $value)
                $list[] = (int)$value;
            //print_r($list);

            setCache($tagChildren, $list, CATEGORY_TTL);
        }
        return $list;
    }

    private function getNavHtml($list, $isFirst) {
        if (is_array($list)) {
            $html = '';
            foreach($list as $val) {
                if (isset($val['subNav'])) {
                    $html .= $this->getNavHtmlHaveChild($val, $isFirst);
                } else {

                    $html .= $this->getNavHtmlNotChild($val);
                }
            }
            return $html;

        } else {
            return false;
        }
}

    private function getNavHtmlNotChild($val) {
        $html = '';
        $html .=
            '<li><a href="' .$val['url'] .'">' .$val['cname'] .'</a><li>';

        return $html;
    }

    private function getNavHtmlHaveChild($val, $isFirst) {
        $html = '';
        $html .=
            '<li class="';
        if ($isFirst == 1) {
            $html .= 'dropdown">';
        } else {
            $html .= 'dropdown-submenu dropdown">';
        }

        $html .=
            '<a id="dLabel" class="nav-a" role="button" data-toggle="dropdown" data-target="#" href="' .$val['url'] .'">' .$val['cname'];

        if ($isFirst == 1) {
            $html .= '<span class="caret"></span></a>';
        } else {
            $html .= '</a>';
        }

        $html .= '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
        $html .= $this->getNavHtml($val['subNav'], 2);
        $html .=
            '</ul>'
            .'</li>';
        return $html;

    }


    /**
     * @param &$list
     **/
    private function getSubNav(&$list) {
        foreach($list as &$value) {
            $where['status'] = 1;
            $where['pid'] = $value['id'];
            $value['url'] = U('category/'.$value['id'] .C('URL_HASH'));
            if(($subNav = $this->where($where)->order('sort DESC')->select())) {
                $value['subNav'] = $subNav;
                $this->getSubNav($value['subNav']);
            }
        }
    }

}
?>

