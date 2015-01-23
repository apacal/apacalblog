<?php
//$config	=	require APP_PATH .'Common/Conf/config.php';
//SITE_URL = '';
//$home_config =
    return array(

    'COMMENT_HASH'      =>      '#comment-post',
    'TMPL_CACHE_ON'                 =>              false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
    'SITE_NAME'			=>          'Apacal网络日志',   //网站名字
    'SITE_NAME_BAR'     =>          '激情 程序 奋斗',
    'SITE_KEYWORDS'		=>  'zhongqingzhu 钟庆柱 Apacal Apacal网络日志 apacalblog Apacal Apacal个人博客 激情 奋斗 技术的乐趣、快乐',
    'SITE_DESCRIPTION'	=>  '分享一些对技术的思考，扯一些生活的感悟，享受技术带来的乐趣、快乐，享受编程带的乐趣、快乐。',

    'DEFAULT_THEME' => 'simple',

    'SHOW_PAGE_TRACE'               =>              true,
    'PAGE_TRACE_SAVE'               =>              false,

    'SEARCH_TABLE'       =>     array(
                    'Article',
                ),
    'SEARCH_COL'         =>     array(
                    'title',
                    'content',
                ),
    'SEARCH_SET_COL'         =>     array(
                    'title',
                ),
    'URL_HTML_SUFFIX'   =>          'html',  //网站静态后缀
    'EVERY_PAGE_NUM'  =>          10,  //每次加载的文章的数目
	'URL_MODEL'         =>          2,           //服务器开启Rewrite模块时，可去除URL中的index.php 参数模式1,2,3
	
	'DB_LIKE_FIELDS'		=> 'title|remark|content',	//搜索Like匹配字段
    'URL_ROUTER_ON'         => true,
    'URL_ROUTE_RULES'       => array(

            // article/id => Article/view/id/$id
            'article/:id\d'             =>      'Article/view',
            'category/:cid\d'           =>      'Category/index',
            'date/:cid/:time'           =>      'Article/date',
            'tag/:name'               =>      'Article/tag',
            'user/:id\d'                =>      'User/view',
            'Verify/index/:time'                =>      'Verify/index',



            'note/:cid\d'           =>      'Note/index',
            'search'                 =>      'Index/search',
            'book/my'                      =>      'Index/book',
            'aboutme/my'                      =>      'Index/aboutme',
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
//return array_merge($config,$home_config);
