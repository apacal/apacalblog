<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class CategoryController extends CommonController {

    public function index(){
        $cid = I('request.cid');
        if(empty($cid) || !is_numeric($cid))
            $this->error("参数错误！");
        $mid = M('Category')->where(array('id' => $cid))->getField('mid');
        $controller = M('Model')->where(array('id' => $mid))->getField('mcontroller');
        redirect(C('WEB_URL').'/index.php/'.$controller.'/index/cid/'.$cid);
    }
}
