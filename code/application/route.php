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
    '__pattern__'         => [
        'name' => '\w+',
        'id'   => '\d+',
    ],
    // '[hello]'     => [
    //     ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
    //     ':name' => ['index/hello', ['method' => 'post']],
    // ],
    // 'new/:id'  => 'News/read',
    // 'blog/:id' => ['Blog/update', ['method' => 'post|put'], ['id' => '\d+']],
    // 'hello/:name'   => 'index/hello',
    'hello/[:name]'       => 'index/hello',
    'news/[:id]'          => 'news/read',
    'con/[:time]'         => ['console/index/index', ['method' => 'get'], ['time' => '\d+']],
    'conlogin/[:time]'    => ['console/login/index', ['time' => '\d+']],
    'conloginout/[:time]' => ['console/login/loginout', ['time' => '\d+']],

];
