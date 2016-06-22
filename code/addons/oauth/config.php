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
    'independent'  => [
        'title'   => '独立配置',
        'type'    => 'select',
        'options' => [
            '0' => '公共配置模板',
            '1' => '独立配置模板',
        ],
        'value'   => '1',
        'tip'     => '配置时是否调用独立配置模板',
    ],
    'oauth_status' => [ //配置在表单中的键名 ,这个会是config[random]
        'title'   => '第三方登录状态:', //表单的文字
        'type'    => 'select', //表单的类型：text、textarea、checkbox、radio、select等
        'options' => [ //select 和radion、checkbox的子选项
            '1' => '启用', //值=>文字
            '0' => '禁用',
        ],
        'value'   => '1', //表单的默认值
    ],
// 'think_sdk_qq'    => [
    //         'app_key'    => '100251165',
    //         'app_secret' => '114d7761ae3f641f82aded9acce3c5a4',
    //         'callback'   => 'http://www.benweng.com/oauthcallback?type=qq',
    //     ],

//     'think_sdk_sina'  => [
    //         'app_key'    => '4198022214',
    //         'app_secret' => 'bfaf29ca1f9586af79060947856b42e9',
    //         'callback'   => 'http://www.benweng.com/oauthcallback?type=sina',
    //     ],

//     'think_sdk_baidu' => [
    //         'app_key'    => '00VgPgxfGjNPwi2WzBAsVOAy',
    //         'app_secret' => 'VjQ3Dw2l6DGpfoveQQyCms3iIErYqHYz',
    //         'callback'   => 'http://www.benweng.com/oauthcallback?type=sina',
    //     ],
    'group'        => [
        'type'    => 'group',
        'options' => [
            'think_sdk_qq'   => [
                'title'   => 'QQ 配置',
                'options' => [
                    'think_sdk_qq_app_key'    => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_qq_app_secret' => [
                        'title' => '应用secret',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_qq_callback'   => [
                        'title' => '回调地址',
                        'type'  => 'text',
                        'value' => '',
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
                        'tip'     => 'dd',
                    ],
                ],
            ],
            'think_sdk_sina' => [
                'title'   => 'SINA 配置',
                'options' => [
                    'think_sdk_sina_app_key'    => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_sina_app_secret' => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'think_sdk_sina_callback'   => [
                        'title' => '回调地址',
                        'type'  => 'text',
                        'value' => '',
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
                        'tip'     => 'dd',
                    ],
                ],
            ],
        ],
    ],
];
