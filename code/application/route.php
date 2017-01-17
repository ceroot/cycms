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
    '__pattern__'       => [
        'name'  => '\w+',
        'id'    => '\d+',
        'year'  => '\d{4}',
        'month' => '\d{2}',
    ],
    // '[hello]'     => [
    //     ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
    //     ':name' => ['index/hello', ['method' => 'post']],
    // ],
    // 'new/:id'  => 'News/read',
    // 'blog/:id' => ['Blog/update', ['method' => 'post|put'], ['id' => '\d+']],
    // 'hello/:name'   => 'index/hello',
    //'hello/[:name]'     => 'index/hello',
    'news/[:id]'        => 'news/read',
    'con/[:time]'       => ['console/index/index', ['method' => 'get'], ['time' => '\d+']],
    'conlogin/[:time]'  => ['console/login/index', ['time' => '\d+']],
    'conlogout/[:time]' => ['console/login/logout', ['time' => '\d+']],
    'api/:table/[:id]'  => ['api/api/index', []], //array('api/api/index'),
    // 'hello/:name'       => ['api/api/index', [], ['name' => '\w+']],
    'oauthlogin1'       => ['index/oauth/login', []],
    'oauthcallback1'    => ['index/oauth/callback', []],
    'addons'            => ['console/addons/execute?_addons=ycEditor&_controller=Upload&_action=index', []],
    // 'oauthaddons'       => ['console/addons/execute?_addons=oauth&_controller=Oauth&_action=index', []],
    'oauthaddons'       => ['api/oauth/execute?_addons=oauth&_controller=Oauth&_action=index', []],
    'oauthlogin'        => ['api/oauth/execute?_addons=oauth&_controller=Oauth&_action=login', []],
    'oauthcallback'     => ['api/oauth/execute?_addons=oauth&_controller=Oauth&_action=callback', []],

    'weixin'            => ['weixin/index/index', []],

    '__domain__'        => [
        'www.gylbgg.com'   => 'dot',
        'gylb.benweng.com' => 'dot',
        // 泛域名规则建议在最后定义
        // '*.user'         => 'user',
        // '*'              => 'book',
    ],

];
