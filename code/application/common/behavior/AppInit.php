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
 * @date      2016-06-02 14:07:52
 * @site      http://www.benweng.com
 */
namespace app\common\behavior;

use think\Config;

class AppInit
{
    public function run(&$params)
    {
        $this->initialization();
        //注册路由
        if (Config::get('url_route_on')) {
            $this->router();
        }

    }

    private function router()
    {
        $router_rule['d']    = 'dot/index/index';
        $router_rule['test'] = 'index/index/test';
        \think\Route::rule($router_rule);
    }

    //初始化
    private function initialization()
    {

        define('NOW_TIME', $_SERVER['REQUEST_TIME']);

    }

}
