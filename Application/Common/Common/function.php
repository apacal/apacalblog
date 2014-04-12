<?php
/**
 * 应用默认加载的文件，一些基本函数
 **/

/**
 * 搜略图名称转换
 * @static
 * @access public
 * @param string $str 需要转换的字符串 行如这样/Advert/20140314/1394788964.png
 * @return string
 */
function getThunmName($str) {
	$pattern = '/([^\/]+\.[^}]+)/i';
	$replacement = C(THUMB_PREFIX).'${1}';
	return preg_replace($pattern, $replacement, $str);
}
/**
 * 字符串截取，
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8") {
    //$str = preg_replace('/\s*/', '', $str); 
  //  $str = strip_tags($str);
    $slice = mb_substr($str, $start, $length, $charset);
    $len = strlen($str);
    if($len > $length + 10)
        $slice .= '...';
    return $slice;
}

?>
