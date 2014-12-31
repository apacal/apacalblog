<?php
/**
 * Admin控制器
 **/
namespace Admin\Controller;
use Admin\Model\AdminModel;
use Admin\Model\UploadModel;
use Think\Controller;
class AdminController extends CommonController {
    protected $manageSort = "adminid desc";
    protected $pkId = "adminid";

    public function  __edit($vo) {
        $url = U(CONTROLLER_NAME .'/update', array('id' => $vo['adminid']));
        $this->assign('action_url', $url);
    }
    public function index() {
        $id = $_SESSION['adminid'];
        $info = M('Admin')->where(array('adminid' => $id))->find();
        $this->assign('vo', $info);
        $this->display();
    }
    
    public function insert() {
        $model= new AdminModel();
        if(!($data = $model->create())) {
            $this->error($model->getError());
        }
        $map['adminname'] = $data['adminname'];
        if(M('Admin')->where($map)->find())
            $this->error('用户已经存在!');
        $upload = new UploadModel();
        $image = $upload->uploadImage('Admin', 3, true, 200, 200);
        if(!$image) {
            $this->error('图片不能为空！');
        }
        $data['image'] = $image;
        $data['status'] =  $data['status'] == 'on' ? 1 : 0;
        $data['isadmin'] =  $data['isadmin'] == 'on' ? 1 : 0;
        if(!$model->insert($data)) {
            $this->error($model->getError());
        }
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
        $model= new AdminModel();
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

        $upload = new UploadModel();
        $image = $upload->uploadImage('Admin', 3, true, 200, 200);
        if($image) {
            $data['image'] = $image;
        }
        $data['status'] =  $data['status'] == 'on' ? 1 : 0;
        $data['isadmin'] =  $data['isadmin'] == 'on' ? 1 : 0;
        unset($data['createtime']);//unset createtime
        $where['adminid'] = $id;
        if(!empty($data['password'])) {
            $data['pwd'] = createHash($data['password']);
        }
        if(!$model->where($where)->save($data)) {
            $this->error($model->getError());
        } else {
            //var_dump($data);
            $this->success('更新管理员成功!', __CONTROLLER__.'/manage');
        }
    }
}

