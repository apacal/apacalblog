<?php
namespace Admin\Model;
class MenuModel extends CommonModel {
    protected $_auto = array( //自动完成
        array('createtime', 'time', self::MODEL_INSERT, 'function'),
        array('updatetime', 'time', 3, 'function'),
        array('adminid', 'getAdminId', 3, 'callback'),
    );

    /**
     * 获取管理员id
     **/
    protected function getAdminId() {
        $adminid = $_SESSION['adminid'];
        if($adminid)
            return $adminid;
        return 1;
    }

    protected $_validate = array(
        array('name','require','名字必须！'),

    );

    /**
     * get all menu
     * @return bool | array
     */
    public function getAllMenu() {
        $map['pid'] = 0;
        if ( $list = $this->where($map)->order('sort DESC')->select() ) {
            return $this->getAllMenuSub( $list );
        } else {
            return false;
        }

    }
    private function getAllMenuSub( $list ) {
        $allMenu = array();
        foreach($list as $val) {
            $allMenu[] = $val;
            $map['pid'] = $val['id'];
            $sub = $this->where($map)->order("sort DESC")->select();
            if (!empty($sub) && is_array($sub)) {
                $sub = $this->getAllMenuSub($sub);
                foreach($sub as $value) {
                    $allMenu[] = $value;
                }
            }
        }
        return $allMenu;
    }

    /**
     * get memu position
     * @param $id | int
     * @return array
     */
    public function getPosition( $id ) {
        $menu = $this->where( array('id' => $id) )->find();
        $menu['url'] = $this->getMenuUrl( $menu );
        $position[] = $menu;
        while($menu['pid'] != 0) {
            $menu = $this->where(array('id' => $menu['pid']))->find();
            $menu['url'] = $this->getMenuUrl( $menu );
            $position [] = $menu;
        }
        $data = array();
        while($position) {
            $data[] = array_pop($position);
        }
        return $data;
    }
    /**
     * get all menu
     * @param $currId | int
     * @return array|false
     */
    public function getMenu( $currId ) {
        $pid = 0;
        $menuData = $this->getMenuByPid($pid);
        $parentIds = $this->getParentIds( $currId );
        $this->getSub($menuData, $currId, $parentIds);
        $html = $this->genMenuTreeHtml($menuData);
        return $html;
        return $menuData;
    }

    private function genMenuTreeHtml($menuData) {
        $html = '';
        foreach($menuData as $val) {
            if (empty($val['sub'])) {
                $html .= $this->genTreeHtmlNotSub($val);
            } else {
                $html .= $this->genTreeHtmlHaveSub($val);
            }
        }
        return $html;

    }
    private function genTreeHtmlNotSub($val) {
        return
        '<li class="' .$val['meta'] .'">'
            .'<a href="' .$val['url'] .'">'
                .'<i class="' .$val['icon'] .'"></i>'
                .'<span class="menu-text">' .$val['name'] .'</span>'
            .'</a>'
        .'</li>';
    }
    private function genTreeHtmlHaveSub($val) {
        $html = '';
        $html .=
            '<li class="' .$val['meta'] .'">'
                .'<a href="#" class="dropdown-toggle">'
                    .'<i class="' .$val['icon'] .'"></i>'
                    .'<span class="menu-text">' .$val['name'] .'</span>'
                    .'<b class="arrow icon-angle-down"></b>'
                .'</a>';
        $html .=
            '<ul class="submenu">';
        $html .= $this->genMenuTreeHtml($val['sub']);
        $html .=
            '</ul>';
        $html .=
            '</li>';
        return $html;

    }
    /**
     * get parent id by curr id
     * @param $id | int
     * @return array | false
     */
    private function getParentIds( $id ) {
        $map['status'] = 1;
        $map['id'] = $id;
        $ret = array();
        while ( ( $list = $this->where( $map )->find() )) {
            if (!empty($list) && is_array($list)) {
                $ret[] = $list['pid'];
                $map['id'] = $list['pid'];
            }
        }
        return $ret;
    }

    /**
     * get one menu
     * @param $id | int
     * @return array|bool
     */
    public function getMenuById( $id ) {
        $map['id'] = $id;
        $map['status'] = 1;
        $menu = $this->where($map)->limit( 1 )->select();
        if ( is_array( $menu ) && !empty( $menu ) ) {
            $menu[0]['url'] = $this->getMenuUrl( $menu[0] );
            return $menu[0];
        } else {
            return false;
        }

    }

    /**
     * @param $menuId
     * @return bool | int
     */
    public function getManageMenuId($menuId) {
        $map['status'] = 1;
        $map['id'] = $menuId;
        $menu = $this->where($map)->find();
        $map = array();
        $map['status'] = 1;
        $map['controller'] = $menu['controller'];
        $map['action'] = 'manage';
        if ($menu = $this->where($map)->find()) {
            return $menu['id'];
        } else {
            return false;
        }

    }

    /**
     * @param $pid | int
     * @return array | false
     */
    private function getMenuByPid( $pid ) {
        $map['pid'] = $pid;
        $map['status'] = 1;
        if ( $menu = $this->where($map)->order("sort DESC")->select() ) {
            return $menu;
        } else {
            return false;
        }
    }

    /**
     * get menu's sub menu
     * @param &$menu | array
     * @param &$currId | int
     * @param &$parentIds | array
     */
    private function getSub( &$menu, &$currId, &$parentIds) {
        foreach( $menu as &$val ) {
            if ( $val['id'] == $currId ) {
                $val['meta'] = 'active';
            } else if ( in_array($val['id'], $parentIds ) ){
                $val['meta'] = 'open active';
            } else {
                $val['meta'] = '';
            }
            $val['url'] = $this->getMenuUrl( $val );

            if ( is_array( $sub = $this->getMenuByPid( $val['id'] ) ) && !empty( $val ) ) {
                $this->getSub( $sub , $currId, $parentIds);
                $val['sub'] = $sub;
            }
        }
    }

    /**
     * create menu url, controller == '#' mean it is only menu, not controller to control * @param $menu | array
     * @return string
     */
    private function getMenuUrl( $menu ) {
        if ( $menu['controller'] != '#' ) {
            return U( $menu['controller'] .'/' .$menu['action'], array('menuId' => $menu['id'] ) );
        } else {
            return '';
        }
    }
}
