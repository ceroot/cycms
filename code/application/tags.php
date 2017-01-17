<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-02 14:14:20
 * @site      http://www.benweng.com
 */

// 应用行为扩展定义文件
return [
    // 应用初始化
    'app_init'     => [
        'app\\common\\behavior\\AppInit',
    ],

    // 应用开始
    'app_begin'    => [],

    // 模块初始化
    'module_init'  => [
        'app\\common\\behavior\\ModuleInit',
    ],

    // 操作开始执行
    'action_begin' => [],

    // 视图内容过滤
    'view_filter'  => [],

    // 日志写入
    'log_write'    => [],

    // 应用结束
    'app_end'      => [],
];
