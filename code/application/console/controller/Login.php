<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Lobin.php[登录控制器]
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

    // 登录首页
    public function index()
    {
        // $uniqid = uniqid();
        // $star   = 7;
        // dump($uniqid);
        // dump(substr($uniqid, $star, 13));
        // dump(str_split(substr($uniqid, $star, 13), 1));
        // dump(array_map('ord', str_split(substr($uniqid, $star, 13), 1)));
        // dump(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))));

        // dump(substr(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))), 0, 8));
        // dump(substr(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))), 0, 8));
        // dump('-----------');
        // dump(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))));
        // dump(str_split($uniqid));
        // dump(array_map('ord', str_split($uniqid, 1)));
        // dump(implode(null, array_map('ord', str_split($uniqid, 1))));
        // dump('-----------');

        // dump($no);
        if (IS_POST) {

            if ($user = $this->model->validateLogin()) {
                // 设置登录错误记录的session为0
                session('error_num', 0);
                // 设置session
                $this->model->setSession($user);
                $this->model->updateLogin($user);

                // 登录日志记录
                action_log('manager_login', 'manager', $user['uid'], $user['uid']);
                // url('blog/read?name=thinkphp');
                $time   = date('YmdHis') . getnum();
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
            return $this->fetch();
        }
    }

    // 退出方法
    public function loginout()
    {
        $mid = session('userid');

        session('userid', null);
        session('username', null);
        session('nickname', null);

        action_log('loginout', 'manager', $mid, $mid);

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

    // 验证码方法
    public function verify()
    {
        $config = array(
            'codeSet'  => '0123456789',
            'length'   => 4,
            'fontSize' => 14,
            'fontttf'  => '5.ttf',
        );
        $Verify = new \third\Verify($config);
        $Verify->entry();
    }

}
