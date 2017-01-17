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

$sdk    = include CODE_PATH . 'data/config/sdk.inc.php';
$config = [

    // 应用调试模式，true 开启，false 关闭
    'app_debug'             => true,
    // 应用Trace
    'app_trace'             => true,

    'url_route_on'          => true,

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------
    'log'                   => [
        // 日志记录方式，支持 file sae
        'type' => 'File',
        // 日志保存目录
        'path' => LOG_PATH,
    ],

    // +----------------------------------------------------------------------
    // | Trace设置
    // +----------------------------------------------------------------------
    'trace'                 => [
        //支持Html Console socket
        'type'             => 'Console',
        'host'             => 'localhost',
        // 日志强制记录到配置的client_id
        'force_client_ids' => ['log_cycms'],
        // 限制允许读取日志的client_id
        'allow_client_ids' => ['log_cymcs'],
    ],

    'cms_version'           => '0.9.7.20160621',

    // 配置列表
    // 'extra_config_list'     => [],

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
        'third'  => CODE_PATH . 'third/',
        'addons' => CODE_PATH . 'addons/',
    ],

    // 去掉url方法里的index.php
    // 'base_url'         => '',

    //默认错误跳转对应的模板文件
    'dispatch_error_tmpl'   => 'baseblock' . DS . 'notice.html',
    // 默认成功跳转对应的模板文件
    'dispatch_success_tmpl' => 'baseblock' . DS . 'notice.html',

    'captcha'               => [
        'imageH'   => 34,
        'fontSize' => 14, // 验证码字体大小(px)
        'length'   => 3, // 验证码位数
    ],

    //分页配置
    // 'paginate'              => [
    //     'type'      => 'bootstrap',
    //     'var_page'  => 'page',
    //     'path'      => '',
    //     'list_rows' => 15,
    // ],

    // 'url_domain_deploy'     => true,

];

return array_merge($sdk, $config);
