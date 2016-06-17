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
use think\Hook;

class AppInit
{
    public function run(&$params)
    {
        $this->initialization();
        //注册路由
        if (Config::get('url_route_on')) {
            $this->router();
        }
        $this->hook();

    }

    // 初始化
    private function initialization()
    {

        define('NOW_TIME', $_SERVER['REQUEST_TIME']);

    }

    // 路由
    private function router()
    {
        $router_rule['d']    = 'dot/index/index';
        $router_rule['test'] = 'index/index/test';
        \think\Route::rule($router_rule);
    }

    // 钩子
    private function hook()
    {
        $data = cache('hooks');
        if (!$data) {
            $hooks = db('hooks')->column('addons', 'name'); //getField('name,addons');
            foreach ($hooks as $key => $value) {
                if ($value) {
                    $map['status'] = 1;
                    $names         = explode(',', $value);
                    $map['name']   = array('IN', $names);
                    $data          = db('Addons')->where($map)->column('id,name'); //getField('id,name');
                    if ($data) {
                        $addons = array_intersect($names, $data);
                        Hook::add($key, array_map('get_addon_class', $addons));
                    }
                }
            }

            cache('hooks', Hook::get());
        } else {
            Hook::import($data, false);
        }
    }

}
