<?php
/**
 * 应用默认加载的文件，一些基本函数
 **/


/**
 * set comment user info to session
 * @param $userInfo
 */
function setCommentUserInfo($userInfo) {
    $_SESSION[C('COMMENT_USER_INFO')] = $userInfo;
}

/**
 * get comment user info from session
 * @return array|false
 */
function getCommentUserInfo() {
    return getValueFromSessionByKey(C('COMMENT_USER_INFO'));
}
/**
 * check the password is correct
 * @param $passwd | user input password
 * @param $hash | pwd's hash
 * @return bool
 */
function checkPasswd($passwd, $hash) {
    $params = explode(":", $hash);
    if(count($params) < 2)
        return false;
    $salt = $params[1];
    $passwd = base64_decode($salt) .$passwd .C('SALT');
    if(hash('sha256', $passwd) == $params[0]) {
        return true;
    } else {
        return false;
    }
}

/**
 * use password to create a hash
 * @param $passwd
 * @return string
 */
function createHash($passwd) {
    $SaltByteSize = 64;
    $salt = openssl_random_pseudo_bytes($SaltByteSize);
    $passwd = $salt .$passwd .C('SALT');
    $passwd = hash('sha256', $passwd);
    $salt = base64_encode($salt);
    return $passwd .':' .$salt;

}

/**
 * check this login user is a admin
 * @return bool
 */
function is_admin() {
    $userInfo = getUserInfo();
    if(isset($userInfo['isGroup']) && 1 == $userInfo['isGroup']) {
        return true;
    } else {
        return false;
    }
}

/**
 * check user is login, if is login return uid, or return 0
 * @return int
 */
function is_login() {
    if(isset($_SESSION[C('USER_AUTH_KEY')])) {
        return $_SESSION[C('USER_AUTH_KEY')];
    }
    return 0;
}

/**
 * set User login, set user uid to session
 * @param $uid
 */
function setUserLogin($uid) {
    $_SESSION[C('USER_AUTH_KEY')] = $uid;
}

/**
 * set user info to session
 * @param $info
 * @return bool
 */
function setUserInfo($info) {
    $_SESSION[C("USER_INFO")] = $info;
    return true;
}

/**
 * get user info from session
 * @return false | array
 */
function getUserInfo() {
    return getValueFromSessionByKey(C('USER_INFO'));
}

/**
 * @param $key
 * @return false | array
 */
function getValueFromSessionByKey($key) {
    if(isset($_SESSION[$key])) {
        return $_SESSION[$key];
    } else {
        return false;
    }
}
/**
 * 搜略图名称转换
 * @static
 * @access public
 * @param string $str 需要转换的字符串 行如这样/Advert/20140314/1394788964.png
 * @return string
 */
function getThunmName($str) {
	$pattern = '/([^\/]+\.[^}]+)/i';
	$replacement = C('THUMB_PREFIX').'${1}';
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



function checkMemcahed() {
    if(mem()->set('hello', 'hello') === true) {
        return true;
    } else {
        return false;
    }
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
define("RecentArticleList", 1);
define("RandArticleList", 2);
define("ArticleCount", 3);
define("ArticleCountGroupByDate", 4);
define("ArticleList", 5);
define("PrevArticle", 6);
define("NextArticle", 16);
define("ControllerNameByCategory", 7);
define("Position", 8);
define("Nav", 9);
define("HotArticleList", 10);
define("ThisCategoryChildren", 11);
define("CommentCount", 12);

define("NoteList", 14);

function cacheTag() {
    $args = func_get_args();
    $tag = '';
    foreach($args as $val) {
        $tag .= $val .'_';
    }
    $tag = trim($tag, '_');
    return $tag;
}




?>
