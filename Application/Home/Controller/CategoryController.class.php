<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class CategoryController extends CommonController {

    public function index($cid){
        $cid = I('request.cid');
        if(empty($cid) || !is_numeric($cid))
            $this->error("参数错误！");

        $model = D('Category');
        $controller = $model->getControllerNameByCategory($cid);
       //$url = U('cate'.strtolower($controller).'/'.$cid);
       //var_dump($url);
        redirect(U('cate'.strtolower($controller).'/'.$cid));
    }
}
