<?php

namespace Addons\Library;
use Common\Controller\Addon;

/**
 * 图书插件
 * @author 无名
 */

    class LibraryAddon extends Addon{

        public $info = array(
            'name'=>'Library',
            'title'=>'图书',
            'description'=>'图书查询',
            'status'=>1,
            'author'=>'无名',
            'version'=>'0.1',
            'has_adminlist'=>0,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Library/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Library/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }