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
    'url_route_on'          => true,
    'log'                   => [
        'type' => 'trace', // 支持 socket trace file
    ],
    'cms_version'           => '0.9.1[20160613]',
    // 显示调试信息
    'response_exit'         => true,

    // 配置列表
    // 'extra_config_list' => [],

    // 模板输出替换  //$view->config('parse_str',['__PUBLIC__'=>'/public/'])->fetch();
    'view_replace_str'      => [
        '__PUBLIC__' => '/statics',
        '__STATIC__' => '/statics',
        '__IMAGES__' => '/images',
        '__CSS__'    => '/css',
        '__JS__'     => '/js',
        '__ROOT__'   => '/',
    ],

    // 'default_return_type' => 'json',

    // 手动注册命名空间
    'root_namespace'        => [
        //'third'  => '../third/',
        'third' => CODE_PATH . 'third/',
    ],

    // 去掉url方法里的index.php
    // 'base_url'         => '',

    //默认错误跳转对应的模板文件
    // 'dispatch_error_tmpl'   => APP_PATH . 'notice/error.html',
    'dispatch_error_tmpl'   => 'baseblock' . DS . 'notice.html',
    // 默认成功跳转对应的模板文件
    // 'dispatch_success_tmpl' => APP_PATH . 'notice/success.html',
    'dispatch_success_tmpl' => 'baseblock' . DS . 'notice.html',

    'captcha'               => [
        'imageH'   => 34,
        'fontSize' => 14, // 验证码字体大小(px)
        'length'   => 3, // 验证码位数
    ],

    //分页配置
    'paginate'              => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'path'      => '',
        'list_rows' => 15,
    ],

    // 关闭控制器名的自动转换
    //'url_controller_convert' => false,
    // 关闭操作名的自动转换
    //'url_action_convert'     => false,

];
