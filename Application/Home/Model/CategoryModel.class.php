<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CategoryModel extends RelationModel {

    protected $_link = array(
        'Model' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Model',
            'foreign_key' => 'mid',
            'mapping_fields' => 'mcontroller',
            'as_fields' => 'mcontroller',
        ),
    );

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
     * @param $cid
     * @param &$position
     */
    public function getPosition($cid, &$position) {

        $tagPosition = cacheTag(Position, $cid);
        if (false === ($position = getCache($tagPosition))) {
            $cate = $this->where(array('id' => $cid))->find();
            $cate['url'] = U('category/'.$cate['id']);
            $position[] = $cate;
            while($cate['pid'] != 0) {
                $cate = $this->where(array('id' => $cate['pid']))->find();
                $cate['url'] = U('category/'.$cate['id']);
                $position [] = $cate;
            }
            $new = array();
            while($position) {
                $new[] = array_pop($position);
            }
            $position = $new;

            setCache($tagPosition, $position, C('CATEGORY_TTL'));
        }

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
            '<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="' .$val['url'] .'">' .$val['cname'] .'</a>'
            .'<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
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
            $value['url'] = U('category/'.$value['id']);
            if(($subNav = $this->where($where)->order('sort DESC')->relation(true)->select())) {
                $value['subNav'] = $subNav;
                $this->getSubNav($value['subNav']);
            }
        }
    }

}
?>

