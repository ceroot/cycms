<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Login.php[登录控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-27 11:10:25
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use think\Controller;

class Login extends Controller
{
    public $model;

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        $this->model = model('manager');

    }
    public function test()
    {

    }

    // 登录首页
    public function index()
    {
        // dump(md5('ceroot1'));
        // $testdata['id']   = 1;
        // $testdata['name'] = 'SpringYang';
        // json($testdata);
        if (IS_AJAX) {

            if ($user = $this->model->validateLogin()) {
                // 设置登录错误记录的session为0
                session('error_num', 0);
                // 设置session
                $this->model->setSession($user); // 登录成功，写入缓存
                $this->model->updateLogin($user); // 登录成功，更新最后一次登录

                // 记录登录日志
                action_log('login_console', 'manager', $user['id'], $user['id']);

                $time   = date('YmdHis') . getrandom(128);
                $redata = array('status' => 1, 'info' => '登录成功', 'url' => url('console/index/index?time=' . $time), 'error_num' => 0);
            } else {
                $error_num = session('error_num');
                if ($error_num >= 3) {
                    $redata = array('status' => 0, 'info' => $this->model->getError(), 'show_code' => 1, 'error_num' => $error_num);
                } else {
                    $redata = array('status' => 0, 'info' => $this->model->getError(), 'show_code' => 0, 'error_num' => $error_num);
                }
            }
            // $testdata['id']   = 1;
            // $testdata['name'] = 'SpringYang';
            return $redata;
            return json_encode($redata);
        } else {
            return $this->fetch();
        }
    }

    // 退出方法
    public function logout()
    {
        $mid = session('userid');
        if (!$mid) {
            $this->redirect('console/login/index');
        }

        session('userid', null);
        session('username', null);
        session('nickname', null);

        action_log('logout_console', 'manager', $mid, $mid);

        $backurl = input('get.backurl');
        $backurl = str_replace('/', '%2F', $backurl);
        $backurl = str_replace(':', '%3A', $backurl);
        // $login   = url('index') . '?backurl=' . $backurl;
        $login = url('console/login/index?time=' . time()) . '?backurl=' . $backurl;

        return $this->success('注销成功', $login);
    }

    // 显示验证码
    public function showverify()
    {
        $error_num = session('error_num');
        if ($error_num > 3) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
