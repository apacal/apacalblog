<?php
/**
 * Photo控制器
 **/
namespace Admin\Controller;
use Think\Controller;
class ImageController extends CommonController {
    public function upload() {
        $upload = D('Upload');
        $image = $upload->upload('Image', 4, true, 300, 168);
        if(!$image) {
            //$this->error($upload->getError());
            echo 'error';
            exit(-1);
        }
        $model = M('Image');
        $data['createtime'] = time();
        $data['pid'] = I('request.pid');
        $data['title'] = I('request.title');
        if(empty($data['pid']) || empty($data['title'])) {
            echo 'error';
            exit(-1);
        }
        $data['image'] = $image;
        if($model->add($data)) {
            $image = getThunmName($image);
            echo $image;
        }else{
            echo 'error';
            exit(-1);
        }
    }
    public function update() {
    }
}

