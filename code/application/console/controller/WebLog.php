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
use think\Db;

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

    function list() {
        $methods         = ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'PATCH', 'OPTIONS', 'Ajax', 'Pjax'];
        $request_module  = input('request_module', '');
        $controllers     = array();
        $controllers_arr = array();
        if ($request_module) {
            $controllers_arr = \ReadClass::readDir(APP_PATH . $request_module . DS . 'controller');
            $controllers     = array_keys($controllers_arr);
        }
        $request_controller = input('request_controller', '');
        $actions            = array();
        if ($request_module && $request_controller) {
            $actions = $controllers_arr[$request_controller];
            $actions = array_map('array_shift', $actions['method']);
        }
        $request_action = input('request_action', '');
        $request_method = input('request_method', '');
        //组成where
        $where = array();
        $join  = [
            [config('database.prefix') . 'member_list b', 'b.member_list_id=a.uid', 'LEFT'],
        ];
        if ($request_module) {
            $where['module'] = $request_module;
        }
        if ($request_controller) {
            $where['controller'] = $request_controller;
        }
        if ($request_action) {
            $where['action'] = $request_action;
        }
        if ($request_method) {
            $where['method'] = $request_method;
        }
        //$weblog_list = Db::name('web_log')->alias('a')->join($join)->where($where)->order('otime desc')->paginate(config('paginate.list_rows'), false, ['query' => get_query()]);
        $weblog_list = Db::name('web_log')->order('create_time desc')->paginate(config('paginate.list_rows'), false, ['query' => get_query()]);
        // dump($weblog_list);die;
        $show = $weblog_list->render();
        $show = preg_replace("(<a[^>]*page[=|/](\d+).+?>(.+?)<\/a>)", "<a href='javascript:ajax_page($1);'>$2</a>", $show);
        $this->assign('weblog_list', $weblog_list);
        $this->assign('page', $show);
        $this->assign('request_module', $request_module);
        $this->assign('request_controller', $request_controller);
        $this->assign('request_action', $request_action);
        $this->assign('request_method', $request_method);
        $this->assign('controllers', $controllers);
        $this->assign('actions', $actions);
        $this->assign('methods', $methods);
        if (request()->isAjax()) {
            return $this->fetch('ajax_weblog_list');
        } else {
            return $this->fetch();
        }
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
