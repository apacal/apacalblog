<?php
if(!defined('THINK_PATH')) exit();
define(ROOT_URL,'');
return array(
    'FORBIDDEN'   => ROOT_URL .'/404',
    'SERACHTABLE' => array(         //查询的table
        'Article'
        ),
    'SEARCHCOL' => array(           //like的字段
        'title',
        'keywords',
        'description',
        'content'
        ),
    'SEARCHSETCOL'  => array(       //标记的字段
            'title',
            'description',
        ),
    'RUNTIMESRC' => APP_PATH.'Runtime/',
    'URL_HTML_SUFFIX'=>'',  //网站静态后缀
    'WEBADMIN' => 'Apacal', //网站管理员
    'UPLOAD' => './Uploads',
    'MODULE_ALLOW_LIST'    =>    array('Home','Admin'), //定义模块
    'DEFAULT_MODULE'       =>    'Home', //定义默认模块
    //'VIRE_FILTER' => array('Behavior\TokenBuildBehavior'), //开启表单令牌
    
    'DEFAULT_FILTER' => 'htmlspecialchars', // I函数默认的过滤方法,包括stripslashes、htmlentities、htmlspecialchars和strip_tags等
    /**
     * 表单令牌配置
     **/
    'TOKEN_ON'      =>    false,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

    'URL_CASE_INSENSITIVE'  =>  false,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    
    'DEFAULT_THEME'    =>    'default',// 设置默认的模板主题

	'DB_TYPE'		=>	'mysql',//  数据库类型	
    'DB_DSN' => 'mysql://root:@)!$Apacalblog@localhost:3306/apacalblog#utf8',
	'DB_PREFIX'		=>	'ablg_',//  数据表前缀

    'THUMB_PREFIX'  =>  'ablg_',  //缩略图的前缀


   
	
	//网站系统设置
    'WEB_URL'           =>  ROOT_URL,//网站地址
	'SITE_URL'     		=>  ROOT_URL,//网站地址
	
    'SITE_ROOT_NAME'    =>  'Apacal个人日志 | ', //网站首页名称
    'SITE_KEYWORDS'		=>  'Apacal Apacal个人日志 apacalblog Apacal Apacal个人博客 激情 奋斗 技术的乐趣、快乐',
	'SITE_DESCRIPTION'	=>  '分享一些对技术的思考，扯一些生活的感悟，享受技术带来的乐趣、快乐，享受编程带的乐趣、快乐。',
	'EMAIL'				=>	'apacal@126.com',
	'OFFLINEMESSAGE'	=>	'本站正在维护中，暂不能访问。<br /> 请稍后再访问本站。',
	'ICP_NUM'			=>	'粤ICP备14021869号',
	
);
