<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Action.php[用户行为控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-28 11:11:47
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class WebLog extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();

    }

    public function set()
    {
        $web_log = config('web_log');
        //模块
        $web_log['not_log_module']         = (isset($web_log['not_log_module']) && $web_log['not_log_module']) ? join(',', $web_log['not_log_module']) : '';
        $web_log['not_log_controller']     = (isset($web_log['not_log_controller']) && $web_log['not_log_controller']) ? join(',', $web_log['not_log_controller']) : '';
        $web_log['not_log_action']         = (isset($web_log['not_log_action']) && $web_log['not_log_action']) ? join(',', $web_log['not_log_action']) : '';
        $web_log['not_log_data']           = (isset($web_log['not_log_data']) && $web_log['not_log_data']) ? join(',', $web_log['not_log_data']) : '';
        $web_log['not_log_request_method'] = (isset($web_log['not_log_request_method']) && $web_log['not_log_request_method']) ? join(',', $web_log['not_log_request_method']) : '';

        // dump($web_log);die;
        //控制器 模块
        $controllers = array();
        $actions     = array();
        $modules     = ['index', 'console'];
        foreach ($modules as $module) {
            $arr = get_files_controllers($module);

            foreach ($arr as $key => $v) {
                $controllers[$module][]        = $module . '/' . $key;
                $actions[$module . '/' . $key] = array_map('array_shift', $v['method']);
            }
        }
        $methods = ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'PATCH', 'OPTIONS', 'Ajax', 'Pjax'];
        $this->assign('methods', $methods);
        $this->assign('actions', $actions);
        $this->assign('modules', $modules);
        $this->assign('controllers', $controllers);
        $this->assign('web_log', $web_log);
        return $this->fetch();
    }

}
