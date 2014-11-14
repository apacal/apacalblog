<?php
if(!defined('THINK_PATH')) exit();
define('ROOT_URL', 'http://apacal.cn');
define('ROOT', '.');
return array(

    'WEB_URL'                       =>              ROOT_URL,
    // normal trace not in debug=on
    'SHOW_PAGE_TRACE'               =>              true,
    'PAGE_TRACE_SAVE'               =>              true,

    // normal debug info
    'SHOW_ERROR_MSG'                =>              false,    // 显示错误信息
    'ERROR_MESSAGE'                 =>              '发生错误！',

    'TMPL_STRIP_SPACE'              =>              true, // 是否去除模板文件里面的html空格与换行
    'TMPL_CACHE_ON'                 =>              true, // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_TIME'               =>              0, // 模板缓存有效期 0 为永久，(以数字为值，单位:秒)
    'URL_CASE_INSENSITIVE'          =>              false,  // URL区分大小写




    'FORBIDDEN'                     =>              ROOT_URL .'/404',
    'SERACHTABLE'                   =>              array(         //查询的table
                                                        'Article'
                                                    ),
    'SEARCHCOL'                     =>              array(           //like的字段
                                                        'title',
                                                        'keywords',
                                                        'description',
                                                        'content'
                                                    ),
    'SEARCHSETCOL'                  =>              array(       //标记的字段
                                                        'title',
                                                        'description',
                                                    ),
    'RUNTIMESRC'                    =>              APP_PATH.'Runtime/',
    'URL_HTML_SUFFIX'               =>              '',  //网站静态后缀
    'WEBADMIN'                      =>              'Apacal', //网站管理员
    'UPLOAD'                        =>              ROOT .'/Uploads',
    'MODULE_ALLOW_LIST'             =>              array('Home','Admin'), //定义模块
    'DEFAULT_MODULE'                =>              'Home', //定义默认模块
    //'VIRE_FILTER'                 =>              array('Behavior\TokenBuildBehavior'), //开启表单令牌
    
    'DEFAULT_FILTER'                =>              'htmlspecialchars', // I函数默认的过滤方法,包括stripslashes、htmlentities、htmlspecialchars和strip_tags等

    /**
     * 表单令牌配置
     **/
    'TOKEN_ON'                      =>              false,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'                    =>              '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'                    =>              'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'                   =>              true,  //令牌验证出错后是否重置令牌 默认为true


    'DEFAULT_THEME'                 =>              'default',// 设置默认的模板主题


    // pdo
    'DB_TYPE'                       =>              'pdo', // 数据库类型
    'DB_USER'                       =>              'root', // 用户名
    'DB_PWD'                        =>              'dev2014', // 密码
    'DB_PORT'                       =>              3306, // 端口
    'DB_PREFIX'		                =>	            'ablg_',//  数据表前缀
    'DB_DSN'                        =>              'mysql:host=localhost;dbname=apacalblog;charset=utf8',

    // mysqli
    //'DB_DSN'                      =>              'mysqli://apacal:dev2014@localhost:3306/apacalblog#utf8',
    "LOAD_EXT_FILE"                 =>              "MemcahedManager,MemcachedSession",


    // Memcache设置
    'MemCached'     =>   array(
        //'hostname'  =>      '7e4d0da81a0611e4.m.cnhzalicm10pub001.ocs.aliyuncs.com',
        'hostname'  =>      '127.0.0.1',
        'port'      =>      '11211',
        'isSasl'    =>      false,
        'username'   =>      '7e4d0da81a0611e4',
        'passwd'    =>      'Memcache2014'
    ),
    'NoCachedDie' => false,

    //session过期时间
    'SESSION_TTL'       =>          60*60*24,
    'ARTICLE_TTL'       =>          60*60*24,
    'NOTE_TTL'          =>          60*60*24,
    'CATEGORY_TTL'      =>          60*60*24*30,
    'COMMENT_TTL'       =>          60*19,



    'THUMB_PREFIX'      =>          'ablg_',  //缩略图的前缀


   
	
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
