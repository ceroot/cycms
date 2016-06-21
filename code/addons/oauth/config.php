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
            'type_qq'   => [
                'title'   => 'QQ 配置',
                'options' => [
                    'qq_key' => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'qq_src' => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'qq_on'  => [
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
            'type_sina' => [
                'title'   => 'SINA 配置',
                'options' => [
                    'sina_key' => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'sina_src' => [
                        'title' => '应用key',
                        'type'  => 'text',
                        'value' => '',
                        'tip'   => 'fdsf',
                    ],
                    'sina_on'  => [
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
