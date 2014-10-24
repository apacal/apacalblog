<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 10/8/14
 * Time: 3:35 PM
 */


class MemcachedManager {
    public static $mySelf = null;
    public static $memcached = null;

    public static function getInstance() {
        if (!(self::$mySelf instanceof self)){
            self::$mySelf = new self;
        }
        return self::$memcached;
    }


    public function __construct() {
        $config = C('MemCached');

        self::$memcached = new Memcached;  //声明一个新的memcached链接
        self::$memcached->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
        self::$memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
        self::$memcached->addServer(isset($config['hostname']) ? $config['hostname'] : 'http://localhost', isset($config['port']) ? $config['port'] : '11211'); //添加OCS实例地址及端口号

        if (isset($config['isSasl']) && $config['isSasl'] === true) {
            self::$memcached->setSaslAuthData(isset($config['username']) ? $config['username'] : 'apacal', isset($config['passwd']) ? $config['passwd'] : 'dev2014'); //设置OCS帐号密码进行鉴权
        }

    }


}

function mem() {
    try {
        return MemcachedManager::getInstance();

    } catch(Exception $e) {
        return false;
    }
}
