<?php
/**
 * 后台Controller基础类
 **/
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function index() {
        $this->display();
    }
	public function _initialize(){
        if (!$_SESSION [C('ADMIN_AUTH_KEY')]) {
	        redirect(__MODULE__ . C('ADMIN_AUTH_GATEWAY'));
        }
    }
    public function _before_add() {
        $this->setNavList();
    }
    public function _before_edit() {
        $this->setNavList();
    }
    protected $field = '*';
    /**
     * 添加，展示页面
     **/
    public function add() {
        $this->display();
    }
    public function del() {
        $model = M(CONTROLLER_NAME);
        $where['id'] = I('request.id');
        if($model->where($where)->delete())
            redirect(__CONTROLLER__.'/manage');
        else
            $this->error($model->getError());
    }
    /**
     * insert
     **/
    public function insert() {
        $model = D(CONTROLLER_NAME);
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        if(!$model->add($data))
            $this->error($model->getError());
        else
            $this->success('添加成功!', __CONTROLLER__.'/manage');
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
        if(!$model->where($where)->save($data))
            $this->error($model->getError());
        else
            $this->success('更新成功!', __CONTROLLER__.'/manage');
    }
    /**
     * 编辑页面
     **/
    public function edit() {
        $model = M(CONTROLLER_NAME);
        $where['id'] = I('request.id');
        $vo = $model->where($where)->find();
        //$vo['content'] = str_replace(array('<div>','</div>'), '', $vo['content']);
        if($vo['cid']) {
            $where['id'] = $vo['cid'];
            $vo['cname'] = M('Category')->where($where)->getField('cname');
        }
        $this->assign('vo', $vo);
        $this->display();
    }
    /**
     * 管理页面
     **/
    public function manage() {
        $model = M(CONTROLLER_NAME);
        $list = $model->field($this->field)->order('createtime DESC')->select();
        $this->assign('list', $list);
        $this->display();
    }
    /**
     * 检查验证码
     **/
    public function checkVerify() {
        $verify = new \Think\Verify();
        $code = I('post.verify');
        $id = '';
        if(!($verify->check($code, $id)))
            $this->error("验证码错误!", __CONTROLLER__.'/login');
    }
    // 生成验证码
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
    //所有栏目
    protected function setAllNavList() {
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
    //所有Model
    protected function setAllModelList() {
        $where['status'] = 1;
        $list = M('Model')->where($where)->select();
        $this->assign('modelList', $list);
    }
    //获取栏目列表
    protected function setNavList($mid) {
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
}
