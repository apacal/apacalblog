<?php
$config	=	require './Application/Common/Conf/config.php';
$config['WEB_URL'] = '';
$admin_config	= array(
    'SALT'                      => 'ApacalBlogAdmin',
    'SITE_NAME'			=>  'ApacalBlog后台管理系统',//网站名字，后台的和前台不一样

    'URL_MODEL'					=>2, 				// 如果你的环境不支持PATHINFO 请设置为3
	'TMPL_CACHE_ON'				=>true, 			//开启模板缓存
	'ADMIN_AUTH_ON'				=>true,
	'ADMIN_AUTH_TYPE'			=>1,				// 默认认证类型 1 登录认证 2 实时认证
    'ADMIN_AUTH_KEY'			=>'administrator',// ADMIN认证SESSION标记
	'ADMIN_AUTH_GATEWAY'			=>'/Public/login',	// 默认认证网关

    /* 模版变量设置 */
	'TMPL_PARSE_STRING' => array(
		'__WEB_URL__'			=> $config['WEB_URL'],
		'__ACE__' 				=> $config['WEB_URL'].'/Public/ace',
		'__PUBLIC__' 			=> $config['WEB_URL'].'/Public',
		'__CSS__' 				=> $config['WEB_URL'].'/Public/css',
		'__IMG__' 				=> $config['WEB_URL'].'/Public/images',
		'__JS__' 				=> $config['WEB_URL'].'/Public/js',
		'__BS__' 				=> $config['WEB_URL'].'/Public/bootstrap',
		'__UPLOAD__' 			=> $config['WEB_URL'].'/Uploads',
	),	

    //session过期时间
    'SESSION_TTL'   =>  60*60*24*7,
    'NoCachedDie' => true,

    /* 分页设置 */
	'PAGE_ROLLPAGE'   	        => 5,      // 分页显示页数
	'PAGE_LISTROWS'         	=> 20,     // 分页每页显示记录数
	

	
);
return array_merge($config,$admin_config);
