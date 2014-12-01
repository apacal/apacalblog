<?php
/**
 * 后台Controller基础类
 **/
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    protected $field = '*';

    public function index() {
        $this->manage();
        $this->display(CONTROLLER_NAME .':manage');
    }
	public function _initialize(){
        if (!$_SESSION [C('ADMIN_AUTH_KEY')]) {
	        redirect(__MODULE__ . C('ADMIN_AUTH_GATEWAY'));
        }
        $this->initMenu();
    }

    /**
     * init menu and menu position
     */
    private function initMenu() {
        $arr = array(
            'add',
            'update',
            'delete',
            'insert',
            'edit',
            'delAllRuntime',
            'delHomeRuntime',
            'delAdminRuntime',
        );

        $currId = I( 'get.menuId' );
        if ( empty( $currId ) || !is_numeric($currId) ) {
            if ( !in_array( ACTION_NAME, $arr) ) {
                $this->error('current menu is missing!');
            }
        } else {
            $_SESSION['mid'] = $currId;
        }

        $model = D( 'Menu' );

        $menu = $model->getMenu( $currId );
        $this->assign( 'menu', $menu );

        $thisMenu = $model->getMenuById( $currId );
        $this->assign( 'thisMenu', $thisMenu );

        $position = $model->getPosition( $currId );
        $this->assign( 'position', $position );
    }

    /**
     * create a hash
     * @param $passwd
     * @return string
     */
    protected function createHash($passwd) {
        $SaltByteSize = 64;
        $salt = mcrypt_create_iv($SaltByteSize, MCRYPT_DEV_URANDOM);
        $passwd = $salt .$passwd .C('SALT');
        $passwd = hash('sha256', $passwd);
        $salt = base64_encode($salt);
        return $passwd .':' .$salt;
        
    }

    /**
     * reset this model's sort
     */
    public function resetAllSort() {
        $model = D(CONTROLLER_NAME);
        $pk = $model->getPk();
        $list = $model->field($pk)->select();
        foreach($list as $val) {
            $where[$pk] = $val[$pk];
            $data['sort'] = 0;
            $model->where($where)->save($data);
        }
        $this->success("重置成功！");
    }

    public function _after_manage() {
        $this->display();
    }

    public function add() {
        $this->display(CONTROLLER_NAME .':edit');
    }

    public function del() {
        $model = M(CONTROLLER_NAME);
        $where['id'] = I('request.id');
        if($model->where($where)->delete())
            redirect(__CONTROLLER__.'/manage');
        else
            $this->error($model->getError());
    }

    public function insert() {
        $model = D(CONTROLLER_NAME);
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        if(!$model->add($data)) {
            $this->error($model->getError());
        } else {
            $this->success('添加成功!', $this->getSuccessUrl(__CONTROLLER__.'/manage'));
        }
    }

    public function update() {
        $model = D(CONTROLLER_NAME);
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $id = I('request.id');
        if(empty($id) || !is_numeric($id))
            $this->error('参数错误！');
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;

        unset($data['createtime']);//unset createtime
        $where['id'] = $id;
        if(!$model->where($where)->save($data)) {
            $this->error($model->getError());
        } else {

            $this->success('更新成功!', $this->getUrl(CONTROLLER_NAME .'/manage'));
        }
    }

    public function edit() {
        $model = M(CONTROLLER_NAME);
        $where['id'] = I('request.id');

        $vo = $model->where($where)->find();
        if($vo['cid']) {
            $where['id'] = $vo['cid'];
            $vo['cname'] = M('Category')->where($where)->getField('cname');
        }
        $this->assign('vo', $vo);
        $this->display();
    }

    public function manage() {
        $menuId = I('request.menuId');
        $model = M(CONTROLLER_NAME);
        $list = $model->field($this->field)->order('updatetime DESC')->select();
        if (is_array($list)) {
            foreach ($list as &$val) {
                $val['url'] = $this->getEditUrl($val, $menuId);
            }
        }

        $this->assign('list', $list);
    }

    /**
     * delete many
     */
    public function foreverDel() {
        $ids = $_POST['ids'];
        if($ids == '' || !$ids)
            $this->error('参数错误!');
        $model = D(CONTROLLER_NAME);
        if (!empty($model)) {
            $pk = $model->getPk();
            $allid = (explode(',', $ids));
            array_pop($allid);
            foreach ($allid as $val) {
                $where[$pk] = $val;
                $model->where($where)->delete();
            }
            echo 1;
        }
    }

    public function checkVerify() {
        $verify = new \Think\Verify();
        $code = I('post.verify');
        $id = '';
        if(!($verify->check($code, $id)))
            $this->error("验证码错误!", __CONTROLLER__.'/login');
    }

    /**
     * create verify
     */
    public function verify() {
        $config =    array(
            'fontSize'    =>    50,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
         //   'useImgBg'    =>    true, //开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
        );
        $Verify =     new \Think\Verify($config);
        $Verify->entry();
    }

    /**
     * set all category select tree
     */
    protected function setAllCategoryTree() {
        $where['status'] = 1;
        $list = M('Category')->where($where)->field('id, pid, cname')->order("sort DESC")->select();
        import('Org.Tree');
        $tree=new \tree($list);
        //格式字符串
        $str="<option value=\$id \$selected>\$spacer\$cname</option>";
        //返回树
        $result = $tree->get_tree(0,$str, -1);
        $this->assign('categoryTree', $result);
    }

    /*
     * set all model list
     */
    protected function setAllModelList() {
        $where['status'] = 1;
        $list = M('Model')->where($where)->select();
        $this->assign('modelList', $list);
    }

    protected function setMenuTree() {
        $list = D('Menu')->relation(true)->select();
        import('Org.Tree');
        $tree=new \tree($list);
        //格式字符串
        $str="<option value=\$id \$selected>\$spacer\$name</option>";
        //返回树
        $result = $tree->get_tree(0,$str, -1);
        $this->assign('menuTree', $result);
    }
    protected function setCategoryTree() {
        $map['mcontroller'] = CONTROLLER_NAME;
        $mid = M('Model')->where($map)->getField('id');
        if($mid) {
            $where['mid'] = $mid;
            $where['status'] = 1;
            $list = M('Category')->where($where)->field('id, pid, cname')->select();
            import('Org.Tree');
            $tree=new \tree($list);
		    //格式字符串
		    $str="<option value=\$id \$selected>\$spacer\$cname</option>";
		    //返回树
		    $result = $tree->get_tree(0,$str, -1);
            $this->assign('categoryTree', $result);
        }
    }

    protected  function getEditUrl( $arr, $menuId ) {
        return U(CONTROLLER_NAME .'/edit', array('id' => $arr['id'], 'menuId' => $menuId));
    }
    protected  function getUrl( $url ) {
        return U($url, array('menuId' => $_SESSION['mid']));
    }
}
