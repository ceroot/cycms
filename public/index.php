<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义代码目录
define('CODE_PATH', __DIR__ . '/../code/');

// 定义应用目录
define('APP_PATH', CODE_PATH . 'application/');

// 开启调试模式
define('APP_DEBUG', true);

// 加载框架引导文件
require __DIR__ . '/../../thinkphp/5.0/start.php';
