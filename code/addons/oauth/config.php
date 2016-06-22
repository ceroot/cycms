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
 * @date      2016-06-17 16:58:41
 * @site      http://www.benweng.com
 */

return [
    'oauth_status' => [ //配置在表单中的键名 ,这个会是config[random]
        'title'   => '第三方登录状态:', //表单的文字
        'type'    => 'select', //表单的类型：text、textarea、checkbox、radio、select等
        'options' => [ //select 和radion、checkbox的子选项
            '1' => '启用', //值=>文字
            '0' => '禁用',
        ],
        'value'   => '1', //表单的默认值
    ],
    'group'        => [
        'type'    => 'group',
        'options' => [
            'think_sdk_qq'    => [
                'title'   => 'QQ 配置',
                'options' => [
                    'think_sdk_qq_app_key'    => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '100251165',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_qq_app_secret' => [
                        'title' => '应用secret',
                        'type'  => 'text',
                        'value' => '114d7761ae3f641f82aded9acce3c5a4',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_qq_callback'   => [
                        'title' => '回调地址',
                        'type'  => 'text',
                        'value' => 'http://www.benweng.com/oauthcallback?type=qq',
                        'tip'   => '回调地址',
                    ],
                    'think_sdk_qq_on'         => [
                        'title'   => '开关:',
                        'type'    => 'select',
                        'options' => [
                            '1' => '启用',
                            '0' => '禁用',
                        ],
                        'value'   => '1',
                        'tip'     => '是否启用',
                    ],
                ],
            ],
            'think_sdk_sina'  => [
                'title'   => 'SINA 配置',
                'options' => [
                    'think_sdk_sina_app_key'    => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '4198022214',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_sina_app_secret' => [
                        'title' => '应用secret',
                        'type'  => 'text',
                        'value' => 'bfaf29ca1f9586af79060947856b42e9',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_sina_callback'   => [
                        'title' => '回调地址',
                        'type'  => 'text',
                        'value' => 'http://www.benweng.com/oauthcallback?type=sina',
                        'tip'   => '回调地址',
                    ],
                    'think_sdk_sina_on'         => [
                        'title'   => '开关:',
                        'type'    => 'select',
                        'options' => [
                            '1' => '启用',
                            '0' => '禁用',
                        ],
                        'value'   => '1',
                        'tip'     => '是否启用',
                    ],
                ],
            ],
            'think_sdk_baidu' => [
                'title'   => '百度登录配置',
                'options' => [
                    'think_sdk_baidu_app_key'    => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '00VgPgxfGjNPwi2WzBAsVOAy',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_baidu_app_secret' => [
                        'title' => '应用secret',
                        'type'  => 'text',
                        'value' => 'VjQ3Dw2l6DGpfoveQQyCms3iIErYqHYz',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_baidu_callback'   => [
                        'title' => '回调地址',
                        'type'  => 'text',
                        'value' => 'http://www.benweng.com/oauthcallback?type=baidu',
                        'tip'   => '回调地址',
                    ],
                    'think_sdk_baidu_on'         => [
                        'title'   => '开关:',
                        'type'    => 'select',
                        'options' => [
                            '1' => '启用',
                            '0' => '禁用',
                        ],
                        'value'   => '1',
                        'tip'     => '是否启用',
                    ],
                ],
            ],
        ],
    ],
];
