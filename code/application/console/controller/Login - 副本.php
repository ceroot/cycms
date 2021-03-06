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

use app\common\controller\Extend;

class Login extends Extend
{
    public $model;

    /**
     * [_initialize 初始化]
     */
    public function _initialize()
    {
        //echo 'init<br/>';
        parent::_initialize();
        $this->model = model('manager');
    }

    // 登录首页
    public function index()
    {
        if (request()->isAjax()) {
            return 1;
            die;
            if ($user = $this->model->validateLogin()) {
                // 设置登录错误记录的session为0
                session('error_num', 0);
                // 设置session
                $this->model->setSession($user); // 登录成功，写入缓存
                $this->model->updateLogin($user); // 登录成功，更新最后一次登录

                // 记录登录日志
                action_log($user['id'], 'console_login', 'manager', $user['id']);

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
            return $redata;
        } else {
            // if (session('userid')) {
            //     $this->redirect(input('get.backurl'));
            // }
            return view();
        }
    }

    public function test()
    {
        if (request()->isAjax()) {
            return 1;
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

        action_log($mid, 'console_logout', 'manager', $mid);

        $backurl = input('get.backurl');
        $backurl = str_replace('/', '%2F', $backurl);
        $backurl = str_replace(':', '%3A', $backurl);
        $login   = url('console/login/index?time=' . time()) . '?backurl=' . $backurl;

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
