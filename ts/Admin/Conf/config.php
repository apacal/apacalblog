<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'=> 'mysql',		// 数据库类型
	'DB_HOST'=> 'localhost',	// 数据库服务器地址
	'DB_NAME'=>'ts_airsystem',		// 数据库名称
	'DB_USER'=>'root',			// 数据库用户名
	'DB_PWD'=>'@)!$Apacalblog',			// 数据库密码
	'DB_PORT'=>'3306',			// 数据库端口
	'DB_PREFIX'=>'ts_',			// 数据表前缀
	'DB_SUFFIX'				=> '',			// 数据库表后缀
	'DB_FIELDTYPE_CHECK'	=> false,		// 是否进行字段类型检查
	'DB_FIELDS_CACHE'		=> true,		// 启用字段缓存
	'DB_CHARSET'			=> 'utf8',		// 数据库编码默认采用utf8
	'DB_DEPLOY_TYPE'		=> 0,			// 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
	'DB_RW_SEPARATE'		=> false,		// 数据库读写是否分离 主从式有效
	
	'COOKIE_EXPIRE' => 3600,	//Cookie设置  有效期 7*24*3600 7天
	'COOKIE_PREFIX' => 'ThinkScientific',	//Cookie设置  前缀 避免冲突
    
    'USER_AUTH_ON'              =>  true,
    'USER_AUTH_TYPE'			=>  2,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>  'administrator',
    'USER_AUTH_MODEL'           =>  'Admin',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '/Index/login',// 默认认证网关
);
?>
