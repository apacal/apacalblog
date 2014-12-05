<?php
/**
 * Admin控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    protected $manageSort = "adminid desc";
    protected $pkId = "adminid";

    public function index() {
        $id = $_SESSION['adminid'];
        $info = M('Admin')->where(array('adminid' => $id))->find();
        $this->assign('vo', $info);
        $this->display();
    }
    
    public function insert() {
        $model= D('Admin');
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $map['adminname'] = $data['adminname'];
        if(M('Admin')->where($map)->find())
            $this->error('用户已经存在!');
        $upload = D('Upload');
        $image = $upload->upload('Admin', 3, true, 200, 200);
        if(!$image)
            $this->error('图片不能为空！');
        $data['image'] = $image;
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        //$data['pwd'] = md5($data['password']);
        $data['pwd'] = $this->createHash($data['password']);
        if(!$model->add($data))
            $this->error($model->getError());
        else
            $this->success('添加管理员成功!', __CONTROLLER__.'/manage');
    }

    public function del() {
        $model = M(CONTROLLER_NAME);
        $where['adminid'] = I('request.id');
        if($model->where($where)->delete())
            redirect(__CONTROLLER__.'/manage');
        else
            $this->error($model->getError());
    }
    /**
     **/
    public function update() {
        $model= M('Admin');
        if(I('request.password') != '' && I('request.password')) { //有提交密码
            if(!($data = $model->create())) {
                $this->error($model->getError());
            }
            $data['password'] = $_REQUEST['password'];
        }else{
            $data['adminname'] = I('request.adminname');
            $data['email'] = I('request.email');
            $data['description'] = I('request.description');
            $data['createtime'] = time();
            $data['status'] = I('request.status');
        }
        $id = I('request.id');
        if(empty($id) || !is_numeric($id))
            $this->error('参数错误！');
        $map['adminid'] = array('neq', $id);
        $map['adminname'] = $data['adminname'];
        if(M('Admin')->where($map)->find())
            $this->error('用户已经存在!');
        $upload = D('Upload');
        $image = $upload->upload('Admin', 3, true, 200, 200);
        if($image) {
            $data['image'] = $image;
            $src = C('UPLOAD').I('request.old-image');
            $upload->del($src);
        }
        $data['status'] == 'on' ? $data['status'] = 1 : $data['status'] = 0;
        unset($data['createtime']);//unset createtime
        $where['adminid'] = $id;
        if(!empty($data['password'])) {
            //$data['pwd'] = md5($data['password']);
            $data['pwd'] = $this->createHash($data['password']);
        }
        if(!$model->where($where)->save($data))
            $this->error($model->getError());
        else
            $this->success('更新管理员成功!', __CONTROLLER__.'/manage');
    }
}

