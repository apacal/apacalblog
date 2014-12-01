<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class MenuModel extends RelationModel {
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
    /**
     * a relation model, belongs_to Model
     **/
    protected $_link = array(
        'Model' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Model',
            'foreign_key' => 'mid',
            'mapping_fields' => 'mcontroller,model,mname',
            'as_fields' => 'mcontroller,model,mname',
        ),
    );

    protected $_validate = array(
        array('name','require','名字必须！'),

    );

    /**
     * get all menu
     * @return bool | array
     */
    public function getAllMenu() {
        $map['pid'] = 0;
        if ( $list = $this->where($map)->order('sort DESC')->relation(true)->select() ) {
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
            $sub = $this->where($map)->order("sort DESC")->relation(true)->select();
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
        $menu = $this->where( array('id' => $id) )->relation(true)->find();
        $menu['url'] = $this->getMenuUrl( $menu );
        $position[] = $menu;
        while($menu['pid'] != 0) {
            $menu = $this->where(array('id' => $menu['pid']))->relation(true)->find();
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
        $parentId = $this->getParentId( $currId );
        $this->getSub($menuData, $currId, $parentId);
        return $menuData;
    }

    /**
     * get parent id by curr id
     * @param $id | int
     * @return int | false
     */
    private function getParentId( $id ) {
        $map['id'] = $id;
        $map['status'] = 1;
        $list = $this->where( $map )->limit( 1 )->select();
        if( !empty( $list ) && is_array( $list ) ) {
            return $list[0]['pid'];
        } else {
            return false;
        }
    }

    /**
     * get one menu
     * @param $id | int
     * @return array|bool
     */
    public function getMenuById( $id ) {
        $map['id'] = $id;
        $map['status'] = 1;
        $menu = $this->relation( true )->where($map)->limit( 1 )->select();
        if ( is_array( $menu ) && !empty( $menu ) ) {
            $menu[0]['url'] = $this->getMenuUrl( $menu[0] );
            return $menu[0];
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
        if ( $menu = $this->relation( true )->where($map)->order("sort DESC")->select() ) {
            return $menu;
        } else {
            return false;
        }
    }

    /**
     * get menu's sub menu
     * @param &$menu | array
     * @param &$currId | int
     * @param &$parentId | int
     */
    private function getSub( &$menu, &$currId, &$parentId) {
        foreach( $menu as &$val ) {
            if ( $val['id'] == $currId ) {
                $val['meta'] = 'active';
            } else if ( $val['id'] == $parentId ) {
                $val['meta'] = 'open active';
            } else {
                $val['meta'] = '';
            }
            $val['url'] = $this->getMenuUrl( $val );

            if ( is_array( $sub = $this->getMenuByPid( $val['id'] ) ) && !empty( $val ) ) {
                $this->getSub( $sub , $currId, $parentId);
                $val['sub'] = $sub;
            }
        }
    }

    /**
     * create menu url
     * @param $menu | array
     * @return string
     */
    private function getMenuUrl( $menu ) {
        if ( empty( $menu['url'] ) ) {
            return U( $menu['mcontroller'] .'/' .$menu['function'], array('menuId' => $menu['id'] ) );
        } else {
            return $menu['url'];
        }
    }
}
