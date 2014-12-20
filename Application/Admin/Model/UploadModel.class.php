<?php
/**
* @file UploadModel.class.php
* @brief 上传文件和图片MODEL
* @author Apacal, apacal@126.com
* @version 1
* @date 2014-03-31
 */
namespace Admin\Model;
class UploadModel{
    protected $error;
    protected $info;
    public function getInfo() {
        return $this->info;
    }
    public function getError() {
        return $this->error;
    }

    public function _initialize() {
        C('SHOW_PAGE_TRACE', false);
    }

    /**
     * upload a image to server
     * @param $model
     * @param int $maxSize
     * @param bool $isThumb
     * @param int $maxWidth
     * @param int $maxHeight
     * @param int $type
     * @return bool|string
     */
    public function uploadImage($model, $maxSize = 3, $isThumb = true, $maxWidth = 360, $maxHeight = 202, $type=\Think\Image::IMAGE_THUMB_FILLED) {
        $upload = new \Think\Upload();
        $save_path = '/'.$model.'/image/';
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $this->initUploadConfig($upload, $save_path, $maxSize);
        $this->info = $upload->upload();
        if(false === $this->info) {
            $this->error = $upload->getError();
            return false;
        }
        $info = array_pop($this->info);//取出第一个
        $src = $info['savepath'] .$info['savename'];
        if($isThumb)
            $this->saveThumb($src, $maxWidth, $maxHeight, $type);
        return $this->genUploadUrl($src);
    }

    private function genUploadUrl($src) {
        return 'http://' .$_SERVER['SERVER_NAME'] .'/' .C('UPLOADS_DIR_NAME') .$src;

    }
    private function initUploadConfig($upload, $save_path, $maxSize) {
        $maxSize *= 1048576;
        $upload->maxSize = $maxSize;
        $upload->savePath = $save_path;
        $upload->rootPath = C('UPLOAD');
        $upload->saveName = array('uniqid','');;
        $upload->hash = true;
        $upload->autoSub = true;
        $upload->subName = array('date','Ymd');
    }

    public function uploadFile($model, $maxSize = 3) {
        $upload = new \Think\Upload();
        $save_path = '/'.$model.'/file/';
        $this->initUploadConfig($upload, $save_path, $maxSize);
        $upload->exts = array('tar.gz','bz2','zip','doc', 'rar', 'gz', 'tar', 'pdf','jpg','png','gif','jpeg');
        $this->info = $upload->upload();
        if(false === $this->info) {
            $this->error = $upload->getError();
            return false;
        }
        $info = array_pop($this->info);//取出第一个
        $src = $info['savepath'] .$info['savename'];
        return $this->genUploadUrl($src);
    }

    /**
     * 生成缩略图
     **/
    public function saveThumb($src, $width, $height, $type) {
        $src = C('UPLOAD').$src;
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
