<?php
/**
* @file UploadModel.class.php
* @brief 上传文件和图片MODEL
* @author Apacal, apacal@126.com
* @version 1
* @date 2014-03-31
 */
namespace Admin\Model;
use Think\Model;
class UploadModel extends Model {
    protected $error;
    protected $info;
    public function getInfo() {
        return $this->info;
    }
    public function getError() {
        return $this->error;
    }
    /**
     * 上传
     * @param $model
     **/
    public function upload($model, $maxSize = 3, $isThumb = true, $maxWidth = 360, $maxHeight = 202, $type=\Think\Image::IMAGE_THUMB_FILLED) {
        $maxSize *= 1048576;
        $upload = new \Think\Upload();
        $save_path = '/'.$model.'/image/';
        $upload->rootPath = C('UPLOAD');
        $upload->maxSize = $maxSize;
        $upload->savePath = $save_path;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->saveName = 'time';
        $upload->autoSub = true;
        $upload->subName = array('date','Ymd');
        $this->info = $upload->upload();
        if(!$this->info) {
            $this->error = $upload->getError();
            return false;
        }
        $info = array_pop($this->info);//取出第一个
        $src = $info['savepath'] .$info['savename'];
        if($isThumb)
            $this->saveThumb($src, $maxWidth, $maxHeight, $type);
        return $src;
    }
    /**
     * 上传文件
     * @param $model $maxSize 
     **/
    public function uploadFile($model, $maxSize = 3) {
        $maxSize *= 1048576;
        $upload = new \Think\Upload();
        $save_path = '/'.$model.'/file/';
        $upload->maxSize = $maxSize;
        $upload->rootPath = C('UPLOAD');
        $upload->savePath = $save_path;
        $upload->exts = array('tar.gz','bz2','zip','doc', 'rar', 'gz', 'tar', 'pdf','jpg','png','gif','jpeg');
        $upload->saveName = 'time';
        $upload->autoSub = true;
        $upload->subName = array('date','Ymd');
        $this->info = $upload->upload();
        //$this->info = $upload->uploadOne($_FILES['photo']);
        if(!$this->info) {
            $this->error = $upload->getError();
            return false;
        }
        $info = array_pop($this->info);//取出第一个
        $src = $info['savepath'] .$info['savename'];
        return $src;
    }
    /**
     * 生成缩略图
     **/
    public function saveThumb($src, $width, $height, $type) {
        $src = C(UPLOAD).$src;
        $image = new \Think\Image(); 
		if(is_file($src)){
            $image->open($src);
            // 生成一个缩放后填充大小150*150的缩略图并保存为thumb.jpg
            $src = getThunmName($src);
            $image->thumb($width, $height, $type)->save($src);
        }
    }

    //删除文件
    public function del($src){
		if(!empty($src)){
			if(is_file($src)){
				unlink($src);
                $src = getThunmName($src);
			    if(is_file($src))
				    unlink($src);
				return true;				
			}
	    }
		return false;
    }
}
