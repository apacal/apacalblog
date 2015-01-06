<?php
$config	=	require './Application/Common/Conf/config.php';
$admin_config	= array(


    "KEYWORLDS"                 => 'ApacalBlog-后台管理系统',
    "DESCRIPTION"               => 'ApacalBlog-后台管理系统',

    'URL_MODEL'					=>2, 				// 如果你的环境不支持PATHINFO 请设置为3

    'UPLOADS_DIR_NAME'           =>  'Uploads',   // upload dir name

    /* 模版变量设置 */
	'TMPL_PARSE_STRING' => array(
		'__SITE_URL__'			=> $config['SITE_URL'],
		'__ACE__' 				=> $config['SITE_URL'].'/Public/ace',
		'__PUBLIC__' 			=> $config['SITE_URL'].'/Public',
		'__CSS__' 				=> $config['SITE_URL'].'/Public/css',
		'__IMG__' 				=> $config['SITE_URL'].'/Public/images',
		'__JS__' 				=> $config['SITE_URL'].'/Public/js',
		'__BS__' 				=> $config['SITE_URL'].'/Public/bootstrap',
		'__UPLOAD__' 			=> $config['SITE_URL'].'/Uploads',
        '__SUMMERNOTE__' 				=> $config['SITE_URL'].'/Public/summernote',

        '__GOOGLE_CODE__' 				=> $config['SITE_URL'].'/Public/google-code-prettify',
        '__KALENDAR__' 				=> $config['SITE_URL'].'/Public/kalendar',
	),

    //session过期时间
    'SESSION_TTL'   =>  60*60*24*7,
    'NoCachedDie' => false,


);
return array_merge($config,$admin_config);
