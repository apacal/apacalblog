<?php
$config	=	require './Application/Common/Conf/config.php';
$home_config =  array(
    'URL_HTML_SUFFIX'=>'html',  //网站静态后缀
    'ARTICLE_SHOWNUM' => 12,       //初始文章显示数目 
    'ARTICLE_PAGE_NUM' => '9',  //每次加载的文章的数目
    'COMMENT_SHOWNUM' => 5,       //初始显示comment数目 
    'COMMENT_PAGE_NUM' => 5,  //每次加载的comment的数目
    'SITE_NAME'			=>  'ApacalBlog',   //网站名字
	'TMPL_CACHE_ON'			=> true, 		//开启模板缓存
	'URL_MODEL'             => 1,           //服务器开启Rewrite模块时，可去除URL中的index.php 参数模式1,2,3
	
	'USER_AUTH_KEY'			=> 'homeAuthId',			// 用户认证SESSION标记
	'DB_LIKE_FIELDS'		=> 'title|remark|content',	//搜索Like匹配字段

	

    /* 模版变量设置 */
	'TMPL_PARSE_STRING' => array(
		'__WEB_URL__'			=> $config['WEB_URL'],
		'__PUBLIC__' 			=> $config['WEB_URL'].'/Public',
		'__CSS__' 				=> $config['WEB_URL'].'/Public/css',
		'__IMG__' 				=> $config['WEB_URL'].'/Public/images',
		'__JS__' 				=> $config['WEB_URL'].'/Public/js',
		'__BS__' 				=> $config['WEB_URL'].'/Public/bootstrap',
		'__UPLOAD__' 			=> $config['WEB_URL'].'/Uploads',
	),	

    //邮箱配置
	'SMTP_SERVER' =>'smtp.126.com',					//邮件服务器
	'SMTP_PORT' =>25,	 							//邮件服务器端口
	'SMTP_USER_EMAIL' =>'apacalblog@126.com',			//SMTP服务器的用户邮箱(一般发件人也得用这个邮箱)
	'SMTP_USER'=>'apacalblog@126.com',				//SMTP服务器账户名
	'SMTP_PWD'=>'apacalcms2013',							//SMTP服务器账户密码
	'SMTP_MAIL_TYPE'=>'HTML',						//发送邮件类型:HTML,TXT(注意都是大写)
	'SMTP_TIME_OUT'=>8,								//超时时间
	'SMTP_AUTH'=>true,								//邮箱验证(一般都要开启)

	
);
return array_merge($config,$home_config);
