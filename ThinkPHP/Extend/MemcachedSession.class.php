<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 10/8/14
 * Time: 5:16 PM
 */

require_once dirname(__FILE__) ."/MemcachedManager.class.php";

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
        //return MemcachedManager::getInstance()->set($id, $data, C('SESSION_TTL') ? C('SESSION_TTL') : 60*60*24) ? true : false;
        return MemcachedManager::getInstance()->set($id, $data, 60*60*24) ? true : false;
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


$handler = new MemcachedSession();
session_set_save_handler($handler, true);

