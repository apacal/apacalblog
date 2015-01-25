<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-4
 * Time: 下午2:34
 */

namespace Home\Controller;


use Think\Controller;
use Think\Verify;

class VerifyController extends Controller{

    public function index() {
        $config =    array(
            'fontSize'    =>    80,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            //'useImgBg'    =>    true, //开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
        );
        $Verify =     new Verify($config);
        $Verify->entry();
    }

}