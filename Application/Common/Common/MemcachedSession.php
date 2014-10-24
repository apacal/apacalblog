<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-10-24
 * Time: 下午7:24
 */
//引入MemcachedManager
require_once dirname(__FILE__) ."/MemcachedManager.php";

class MemcachedSession implements SessionHandlerInterface {

    public function open($save_path, $sessionName)
    {
        if (MemcachedManager::getInstance()) {
            return true;
        }
    }

    public function close()
    {
        return true;
    }

    public function read($id)
    {
        return MemcachedManager::getInstance()->get($id);
    }

    public function write($id, $data)
    {
        return MemcachedManager::getInstance()->set($id, $data, C('SESSION_TTL') ? C('SESSION_TTL') : 60*60) ? true : false;
        //return MemcachedManager::getInstance()->set($id, $data, 60*60*24) ? true : false;
    }

    public function destroy($id)
    {
        return MemcachedManager::getInstance()->delete($id);
    }

    public function gc($maxlifetime)
    {
        // don not need to flush session, memcached has ttl


        return true;
    }
}


try {
    $cache_hander = MemcachedManager::getInstance();
    if (!empty($cache_hander)) {
        set_session_hander($cache_hander);
    }
}catch(Exception $e) {
    print_r($e);
}

function set_session_hander(Memcached $cache_hander) {
    if ($cache_hander->set('hello', 'hello') === true) {
        session_set_save_handler($cache_hander, true);
    } else {
        $isToDie = C('NoCachedDie');
        if ($isToDie === true) {
            die('cacehed can not connect');
        }
    }
}
