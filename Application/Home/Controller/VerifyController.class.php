<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-4
 * Time: 下午2:34
 */

namespace Home\Controller;


use Think\Controller;

class VerifyController extends Controller{

    public function index() {
        $len = 5;
        $str = "ABCDEFGHIJKLNMPQRSTUVWXYZ123456789";

        $im = imagecreatetruecolor ( 70, 20 );
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $bgtxt = imagecolorallocate($im, 220, 220, 220);

        //随机调色板
        $colors = array(
            imagecolorallocate($im, 255, 0, 0),
            imagecolorallocate($im, 0, 200, 0),
            imagecolorallocate($im, 0, 0, 255),
            imagecolorallocate($im, 0, 0, 0),
            imagecolorallocate($im, 255, 128, 0),
            imagecolorallocate($im, 255, 208, 0),
            imagecolorallocate($im, 98, 186, 245),
        );

        //填充背景色
        imagefill($im, 0, 0, $bgc);

        //随机获取数字
        $verify = "";
        while (strlen($verify) < $len) {
            $i = strlen($verify);
            $random = $str[rand(0, strlen($str))];
            $verify .= $random;

            //绘制背景文字
            imagestring($im, 6, ($i*10)+3, rand(0,6), $random, $bgtxt);
            //绘制主文字信息
            imagestring($im, 6, ($i*10)+3, rand(0,6), $random, $colors[rand(0, count($colors)-1)]);
        }

        //添加随机杂色
        for($i=0; $i<100; $i++) {
            $color = imagecolorallocate($im, rand(50,220), rand(50,220), rand(50,220));
            imagesetpixel($im, rand(0,70), rand(0,20), $color);
        }

        //将验证码存入$_SESSION中
        $_SESSION["verify"] = $verify;
        $_SESSION['verify_time'] = time();

        //输出图片并释放缓存
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }

    static public function check($code) {

        if ((time() - $_SESSION['verify_time']) > 10*60) {
            return false;
        }
        if($_SESSION["verify"] === $code) {
            $_SESSION['verify'] = '';
            return true;
        } else {
            return false;
        }

    }


} 
