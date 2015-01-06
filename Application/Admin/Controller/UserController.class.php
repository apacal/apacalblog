<?php
/**
 * Admin控制器
 **/
namespace Admin\Controller;
use Admin\Model\UploadModel;
use Admin\Model\UserModel;
use Think\Controller;
use Think\Model;

class UserController extends CommonController {
    protected $manageSort = "uid desc";
    protected $pkId = "uid";

    public function  __edit($vo) {
        $url = U(CONTROLLER_NAME .'/update', array('id' => $vo['uid']));
        $this->assign('action_url', $url);
    }
    public function index() {
        $id = is_login();
        $info = (new UserModel())->where(array('uid' => $id))->find();
        $this->assign('vo', $info);
        $this->display();
    }
    
    public function insert() {
        $model= new UserModel();
        if(!($data = $model->create(I('post'), Model::MODEL_INSERT))) {
            $this->error($model->getError());
        }
        $data = $this->initData($data);

        if(!$model->insert($data)) {
            $this->error($model->getError());
        } else {
            $this->success('添加成功!', __CONTROLLER__.'/manage');
        }
    }

    private function initData($data) {
        $upload = new UploadModel();
        $image = $upload->uploadImage('User', 3, true, 200, 200);
        if($image) {
            $data['image'] = $image;
        }
        $data['status'] =  $data['status'] == 'on' ? 1 : 0;
        $data['isadmin'] =  $data['isadmin'] == 'on' ? 1 : 0;

        $password = I('post.password');
        if(!empty($password)) {
            $data['pwd'] = createHash($password);
        }

        return $data;
    }

    public function del() {
        $model = new UserModel();
        $where['uid'] = I('request.id');
        if($model->where($where)->delete())
            redirect(__CONTROLLER__.'/manage');
        else
            $this->error($model->getError());
    }

    /**
     **/
    public function update() {
        $id = I('request.id');
        if(empty($id) || !is_numeric($id)) {
            $this->error('参数错误！');
        }
        $model= new UserModel();
        if(!($data = $model->create(I('post'), Model::MODEL_UPDATE))) {
            $this->error($model->getError());
        }


        if ($model->checkUserExit($id, $data['name']) === true) {
            $this->error("用户已经存在!");
        }
        $data = $this->initData($data);


        if(false === $model->update($id, $data)) {
            $this->error($model->getError());
        } else {
            $this->success('更新管理员成功!', $this->getManageUrl(CONTROLLER_NAME .'/manage' ));
        }
    }
}

