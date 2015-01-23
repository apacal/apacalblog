<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-21
 * Time: 下午4:23
 */

define("SITE_URL", "http://apacal.cn");
// 定义应用目录
define('APP_PATH','./Application/');
session_start();

static $config;
$config = require($_SERVER['DOCUMENT_ROOT'] .'/Application/Common/Conf/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/Application/Common/Common/MemcachedManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/Application/Common/Common/MemcachedSession.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/Application/Common/Common/function.php');




function C($key, $val = '') {
    global $config;
    if (empty($val)) {
        return $config[$key];
    } else {
        $config[$key] = $val;
        return true;
    }
}

