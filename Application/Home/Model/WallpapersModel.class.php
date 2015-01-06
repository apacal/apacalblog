<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-3
 * Time: 下午11:20
 */

namespace Home\Model;


class WallpapersModel {
    public function getWallpapersUrl() {


        $url = "http://area.sinaapp.com/bingImg?daysAgo=";
        $url .= rand(0, 14);

        return $url;


        // use bing.com image
        $index = rand(0, 10);
        $apiUrl = 'http://www.bing.com/HPImageArchive.aspx?format=js&idx=' .$index .'&n=1';

        $ret = json_decode(file_get_contents($apiUrl));
        if(empty($ret)) {
            return false;
        } else {
            $url = $ret->images[0]->url;
            $url = str_replace('1920x1080', '1366x768', $url);
            return ( $url);
        }


        // user desktoppr.co api
        $apiUrl = 'https://api.desktoppr.co/1/wallpapers/random';
        $ret = json_decode(file_get_contents($apiUrl));
        if(empty($ret)) {
            return false;
        } else {
            $url = $ret->response->image->url;
            return $url;
        }
    }
} 