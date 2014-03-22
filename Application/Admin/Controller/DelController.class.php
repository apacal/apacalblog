<?php
/**
 * 删除controller
 */
namespace Admin\Controller;
use Think\Controller;
class DelController extends CommonController {
    /**
     * 清除全部缓存
    */
    public function delAllRuntime(){
        $src = C('RUNTIMESRC');
        $this->del_dir($src); 
        $this->success("清除全部缓存成功!");
    }
    public function delAdminRuntime(){
        $src = C('RUNTIMESRC');
        $this->del_dir($src); 
        $this->success("清除后台缓存成功!");
    }
    public function delHomeRuntime(){
        $src = C('RUNTIMESRC');
        $this->del_dir($src); 
        $this->success("清除前台缓存成功!");
    }
    /**
     * 系统调用
    **/
    private function del_dir($dir) {
        if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {   
            $str = "rmdir /s/q ".$dir;   
        }else{   
            $str = "rm -fr ".$dir;   
        }   
        $line = system($str, $result);
        if($line)
            echo $result;
    }
}
