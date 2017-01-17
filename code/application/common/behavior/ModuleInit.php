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

use think\Db;
use think\Exception;

class ModuleInit
{
    public function run(&$params)
    {
        $this->initialization(); // 初始化
        $this->config(); // 配置信息
        $this->weblog(); // 网站日志记录

    }

    // 初始化
    private function initialization()
    {
        define('MODULE_NAME', request()->module());
        define('CONTROLLER_NAME', request()->controller());
        define('ACTION_NAME', request()->action());

    }

    // 配置信息处理
    private function config()
    {
        // 读取数据库中的配置并加入配置
        $config = cache('db_config_data');
        if (empty($config)) {
            $config = model('config')->cache_config();
            cache('db_config_data', $config);
        }
        config($config); //添加配置
    }

    // 网站日志记录
    private function weblog()
    {
        $request = request();

        // 不记录的模块
        $not_log_module = config('web_log.not_log_module') ?: array();

        // 不记录的控制器 'module/controller'
        $not_log_controller = config('web_log.not_log_controller') ?: array();

        // 不记录的操作方法 'module/controller/action'
        $not_log_action = config('web_log.not_log_action') ?: array();

        // 不记录data的操作方法 'module/controller/action'
        // 如涉及密码传输的地方：
        // 1、前、后台登录runlogin
        // 2、前台重置密码runpwd_reset
        // 3、前台runregister runchangepwd
        // 4、后台member_runadd member_runedit
        // 5、后台admin_runadd admin_runedit
        $not_log_data = ['runlogin', 'runpwd_reset', 'runregister', 'runchangepwd', 'member_runadd', 'member_runedit', 'admin_runadd', 'admin_runedit'];
        $not_log_data = array_merge($not_log_data, config('web_log.not_log_data') ?: array());

        // 不记录的请求类型
        $not_log_request_method = config('web_log.not_log_request_method') ?: array();
        if (
            in_array($request->module(), $not_log_module) ||
            in_array($request->module() . '/' . $request->controller(), $not_log_controller) ||
            in_array($request->module() . '/' . $request->controller() . '/' . $request->action(), $not_log_action) ||
            in_array($request->method(), $not_log_request_method)
        ) {
            return true;
        }
        // 只记录存在的操作方法
        if (!has_action($request->module(), $request->controller(), $request->method())) {
            return true;
        }
        try {
            if (in_array($request->module() . '/' . $request->controller() . '/' . $request->action(), $not_log_data)) {
                $requestData = '';
            } else {
                $requestData = $request->param();
                foreach ($requestData as &$v) {
                    if (is_string($v)) {
                        $v = mb_substr($v, 0, 200);
                    }
                }
            }
            $data = [
                'uid'         => session('hid') ?: 0,
                'os'          => getOs(),
                'browser'     => getBroswer(),
                'url'         => $request->url(),
                'module'      => $request->module(),
                'controller'  => $request->controller(),
                'action'      => $request->action(),
                'method'      => $request->isAjax() ? 'Ajax' : ($request->isPjax() ? 'Pjax' : $request->method()),
                'data'        => serialize($requestData),
                'create_ip'   => ip2int($request->ip()),
                'create_time' => time(),
            ];
            Db::name('web_log')->insert($data);
        } catch (Exception $e) {

        }
    }

}
