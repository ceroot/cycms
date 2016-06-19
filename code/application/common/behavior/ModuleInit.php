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
 * @date      2016-06-14 16:45:14
 * @site      http://www.benweng.com
 */
namespace app\common\behavior;

class ModuleInit
{
    public function run(&$params)
    {
        $this->initialization();

    }

    //初始化
    private function initialization()
    {
        define('MODULE_NAME', request()->module());
        define('CONTROLLER_NAME', request()->controller());
        define('ACTION_NAME', request()->action());

        // 读取数据库中的配置并加入配置
        $config = cache('db_config_data');
        if (empty($config)) {
            $config = model('config')->cache_config();
            cache('db_config_data', $config);
        }
        config($config); //添加配置

    }

}
