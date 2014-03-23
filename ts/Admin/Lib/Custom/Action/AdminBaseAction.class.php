<?php
class AdminBaseAction extends Action {
    /* AdminBaseAction 为后台的基本类，封装了用户登录检查，验证码等
     * @author Apacal
     * time 2013.05.04
     *
     */


    /* 检查用户是否登录
     * @author Apacal
     * time 2013.05.04
     *
     */
    public function checkAdmin(){
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->error('没有登录,请先登录','__ROOT__/admin.php/Index/login');
        }
        if($_SESSION['status']==0){
            $this->error('该用户已经禁止，请与管理员联系，或使用其他账号','__ROOT__/admin.php/Index/login');
        }
    }
    /* 判断用户权限
     * 审核文章，删除文章需要超级管理员权限
     *
     * @author Apacal
     */
    public function checkStatus() {
        if($_SESSION['group']==0){
            $this->error('您没有权限，只有超级管理员才有权限');
        }
    }
     /*
     * 验证码生成
     * @author Apacal
     * time 2013.05.04
     *
     */
    public function verify() {
        $type=isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }
    /*
     * 验证验证码
     * @author
     * time 2013.05.10
     *
     */
    public function checkVerify() {
        if(session('verify')!=md5($_POST['verify'])){
            $this->error('验证码错误');
        }
    }  
    /* 删除指定记录
     * @author Apacal
     * time 2013.05.06
     *
     */
     public function delete() {
        //删除指定记录
        $this->checkStatus();
        $name = $this->getActionName();
        $model = M($name);
        if (!empty($model)) {
            $id = $_REQUEST ['id'];
            if (isset($id)) {
                if ($model->delete($id)) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }

    /* 更新数据 
     * @author Apacal
     *
     */
    public function update() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=D($name);
        if(!$model->create()) {
            $this->error($model->getError());
        }else{
            $this->checkVerify();
            if($model->save()){
                $this->success('编辑成功','__URL__/manager');
            }else{
                $this->error('编辑失败');
            }
        }
    }
    /* 编辑
     * @author Apacal
     * time 2013.05.06
     *
     */
    public function editor() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        $vo=$model->where("id=$id")->find();
        $this->assign('vo',$vo);
        $this->display();
    }
    /* 查看
     * @author Apacal
     * time 2013.05.06
     *
     */
    public function details() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        $vo=$model->where("id=$id")->find();
        if(empty($model)){
            $this->error('缺少数据');
        }
        $this->assign('vo',$vo);
        $condition['id']=array('lt',$id);
        $this->assign("forword",$model->where($condition)->find());
        $condition['id']=array('gt',$id);
        $this->assign("next",$model->where($condition)->find());
        $this->display();
    }
    /* 用户管理方法
     * @author Apacal
     *
     */
    public function manager() {
        //获取排序的数据，family表示排序的字段表示字段，way表示排序方式
        $way=$_REQUEST['way'];
        $family=$_REQUEST['family'];
        if(!isset($way)){   //初始排序规则
            $way='desc';
            $family='id';
        }
        //字段排序处理完毕

        //对搜索条件进行处理
        $searchKind=$_REQUEST['searchKind'];
        $searchKey=$_REQUEST['searchKey'];
        $search['open']=array('in','0,1');
        if($searchKind==2){
            $search['id']=$searchKey;    
        }
        if($searchKind==1){
            //$search="title like %".$searchKey."%";
            $search['title']=array('like','%'.$searchKey.'%');
        }
        //对搜索条件处理完毕
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=M($name);
        import("ORG.Util.Page");
        $count=$model->where($search)->count();
        $Page=new Page($count,20);
        $list=$model->where($search)->order($family." ".$way)->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('first','第一页');
        $Page->setConfig('last','最后一页');
        $page=$Page->show();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->display();
    }
    
    /* 新数据添加保存
     *
     */
    public function save() {
        $this->checkAdmin();
        $name=$this->getActionName();
        $model=D($name);
        if(!$model->create()){
            $this->error($model->getError());
        }else{
            $this->checkVerify();
            if($model->add($data)){
                $this->success('添加数据成功','__URL__/index');
            }else{
                $this->error('添加数据失败');
            }
        }
    }
    /* 添加
     * @author Apacal
     *
     */
    public function insert() {
        $this->checkAdmin();
        $this->display();
    }
    /* 控制器首页
     * @author
     * time Apacal
     *
     */
    public function index() {
        $this->checkAdmin();
        $this->display();
    }
    /* 文章通过
     * @author Apacal
     *
     */
    public function pass() {
        $this->checkStatus();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        if (isset($id)) {
            $map['open']=1;
            if($model->where("id=$id")->save($map)){
                $this->success('审核成功');
            }else{
                $this->error('文章已经为通过的');
            }
        }else{
            $this->error('非法操作');
        }
    }
    /* 审核文章不通过
     * @author Apacal
     *
     */
    public function unpass(){
        $this->checkStatus();
        $name=$this->getActionName();
        $model=M($name);
        $id=$_REQUEST['id'];
        if(isset($id)){
            $map['open']=0;
            if($model->where("id=$id")->save($map)){
                $this->success("审核成功");
            }else{
                $this->error("文章已经为不通过");
            }
        }else{
            $this->error('非法操作');
        }
    }

                
    
    
}
