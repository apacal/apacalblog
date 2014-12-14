<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-10-25
 * Time: 下午3:18
 */
return  array(
    // exception error
    // trace
    'SHOW_PAGE_TRACE'               =>              true,
    'PAGE_TRACE_SAVE'               =>              true,

    'LOG_TYPE'                      =>              'File', // 日志记录类型 默认为文件方式
    'LOG_RECORD'                    =>              true,  // 进行日志记录
    'LOG_EXCEPTION_RECORD'          =>              true,    // 是否记录异常信息日志
    'LOG_LEVEL'                     =>              'EMERG,ALERT,CRIT,ERR,WARN,NOTIC,INFO,DEBUG,SQL',  // 允许记录的日志级别
    'DB_FIELDS_CACHE'               =>              true, // 字段缓存信息
    'DB_SQL_LOG'                    =>              true, // 记录SQL信息
    'TMPL_CACHE_ON'                 =>              false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_STRIP_SPACE'              =>              true,       // 是否去除模板文件里面的html空格与换行
    'SHOW_ERROR_MSG'                =>              true,    // 显示错误信息
    'ERROR_MESSAGE'                 =>              '发生错误！',
    'URL_CASE_INSENSITIVE'          =>              false,  // URL区分大小写
);