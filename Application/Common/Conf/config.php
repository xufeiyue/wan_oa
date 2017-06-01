<?php
return array(
    //'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'oa',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'qp_',    // 数据库表前缀
    /*定义模版标签*/

    'TMPL_L_DELIM'   		=>'<{',				//模板引擎普通标签开始标记

    'TMPL_R_DELIM'			=>'}>',				//模板引擎普通标签结束标记

);