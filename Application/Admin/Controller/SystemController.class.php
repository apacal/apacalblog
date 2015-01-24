<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends CommonController {
    /**
     * del all cache file
     */
    public function delCache(){
        $src = C('RUNTIMESRC');
        if ($this->del_dir($src) === false) {
            $ret = array(
                'code' => 1,
                'data' => 'some error'
            );
        } else {
            $ret = array(
                'code' => 0,
                'data' => 'success'
            );
        }
        $this->jsonReturn($ret);
    }

    /**
     * call system rm -fr
    **/
    private function del_dir($dir) {
        if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {   
            $str = "rmdir /s/q ".$dir;   
        }else{   
            $str = "rm -fr ".$dir;   
        }   
        $line = system($str, $result);
        return $line;
    }
}
