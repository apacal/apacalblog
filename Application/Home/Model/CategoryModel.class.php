<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class CategoryModel extends RelationModel {

    protected $_link = array(
        'Model' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Model',
            'foreign_key' => 'mid',
            'mapping_fields' => 'mcontroller, model',
            'as_fields' => 'mcontroller,model',
        ),
    );

    /**
     * @param $cid
     * @param $oid
     * @return array | array('cate' => $cata, 'data' => $data)
     */
    public function getExtendInfoByCategoryIdAndObjectId($cid, $oid) {
        $cate = $this->where(array('id'=>$cid))->relation(true)->find();
        if (empty($cate)) {
            return false;
        }
        $origin = (new Model($cate['model']))->where(array('id'=>$oid, 'cid' => $cid))->field('title')->find();
        if(empty($origin)) {
            $origin = false;
        }
        return array('origin' => $origin, 'cate' => $cate);
    }

    /**
     * @param $cid | int
     * @return array|false
     */
    public function getControllerNameByCategory($cid) {
        $tag = cacheTag(ControllerNameByCategory, $cid);
        if (false === ($controller = getCache($tag))) {
            $mid = M('Category')->where(array('id' => $cid))->getField('mid');
            $controller = M('Model')->where(array('id' => $mid))->getField('mcontroller');
            setCache($tag, $controller, C('CATEGORY_TTL'));
        }
        return $controller;
    }

    /**
     * get nav menu
     * @return array|false
     */
    public function getNav() {
        $tagNav = cacheTag(Nav);
        //if (false === ($html = getCache($tagNav))) {
            $where['status'] = 1;
            $where['pid'] = 0;
            $list = $this->where($where)->order('sort DESC')->relation(true)->select();
            $this->getSubNav($list);

            if (false !== ($html = $this->getNavHtml($list, 1))) {
                setCache($tagNav, $html, C('CATEGORY_TTL'));
            } else {
                return false;
            }

        //} else {
            return $html;
        //}
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
     * @param $id
     * @return array | false
     */
    public function getThisCategoryChildren($id) {
        $tagChildren = cacheTag(ThisCategoryChildren, $id);
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

            setCache($tagChildren, $list, C("CATEGORY_TTL"));
        }
        return $list;
    }

    /**
     * @param &$list
     **/
    private function getSubNav(&$list) {
        foreach($list as &$value) {
            $where['status'] = 1;
            $where['pid'] = $value['id'];
            $value['url'] = U('category/'.$value['id'] .C('URL_HASH'));
            if(($subNav = $this->where($where)->order('sort DESC')->relation(true)->select())) {
                $value['subNav'] = $subNav;
                $this->getSubNav($value['subNav']);
            }
        }
    }

}
?>

