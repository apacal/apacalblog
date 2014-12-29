<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Home\Model\CategoryModel;
use Think\Controller;
class CategoryController extends CommonController {

    public function index(){
        $cid = I('request.cid');
        if(!is_numeric($cid)) {
            $this->error("参数错误！");
        }
        $model = new CategoryModel();
        $url = $model->getRedirectUrlByCategory($cid);
        redirect($url);
    }
}
