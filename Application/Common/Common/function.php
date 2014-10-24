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



/**
 * get memCache By key
 * @param $key
 * @return bool|array
 */
function getCache($key) {
    if(false === $data = \mem()->get($key)) {
        return false;
    } else {
        return $data;
    }
}

/**
 * set a cache for memcache
 * @param $key
 * @param $data
 * @param $expiration
 * @return bool
 */
function setCache($key, $data, $expiration ) {
    return \mem()->set($key, $data, $expiration );
}

function deleteCache($key) {
    return \mem()->delete($key);
}


define("OneArticle", 0);
define("NewlyArticleList", 1);
define("RandArticleList", 2);
define("ArticleCount", 3);
define("ArticleCountGroupByDate", 4);
define("ArticleList", 5);
define("ReadNextAndPrev", 6);
define("ControllerNameByCategory", 7);
define("Position", 8);
define("Nav", 9);
define("HotArticleList", 10);
define("ThisCategoryChildren", 11);
define("CommentCount", 12);

define("NoteList", 14);

function cacheTag() {
    try {
        $args = func_get_args();
        if (empty($args)) {
            throw new Exception('loss args');
        }
        $tag = '';
        foreach($args as $val) {
            $tag .= $val .'_';
        }
        $tag = trim($tag, '_');
        return $tag;

    } catch(Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}




?>
