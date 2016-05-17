<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

return [
    'url_route_on'     => true,
    'log'              => [
        'type' => 'trace', // 支持 socket trace file
    ],

    // 显示调试信息
    'response_exit'    => true,

    // 模板输出替换  //$view->config('parse_str',['__PUBLIC__'=>'/public/'])->fetch();
    'view_replace_str' => [
        '__PUBLIC__' => '/statics',
        '__STATIC__' => '/statics',
        '__IMAGES__' => '/images',
        '__CSS__'    => '/css',
        '__JS__'     => '/js',
        '__ROOT__'   => '/',
    ],

    // 'default_return_type' => 'json',

    // 手动注册命名空间
    'root_namespace'   => [
        //'third'  => '../third/',
        'third' => CODE_PATH . 'third/',
    ],

    // 去掉url方法里的index.php
    'base_url'         => '',

    //默认错误跳转对应的模板文件
    //'dispatch_error_tmpl'   => APP_PATH . 'notice/error.html',
    //默认成功跳转对应的模板文件
    //'dispatch_success_tmpl' => APP_PATH . 'notice/success.html',

    'captcha'          => [
        'imageH'   => 34,
        'fontSize' => 14, // 验证码字体大小(px)
        'length'   => 3, // 验证码位数
    ],

];
