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
    public function test()
    {

        $uniqid = uniqid();
        dump($uniqid);

        $uniqid = md5($uniqid);
        //dump($uniqid);

        $uniqid = str_split($uniqid, 1);
        //dump($uniqid);

        $uniqid = array_map('ord', $uniqid);
        //dump($uniqid);

        $uniqid = implode(null, $uniqid);
        //dump($uniqid);

        // $uniqid = substr($uniqid, 0, 32);
        // dump($uniqid);

        // $uniqid = substr(implode(null, array_map('ord', str_split(md5(uniqid()), 1))), 0, 32);
        // dump($uniqid);

        // $uniqid = getnum(8);
        // dump($uniqid);

        // $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max  = strlen($uniqid) - 1;
        $hash = '';
        for ($i = 0; $i < 8; $i++) {
            $temp = $uniqid[mt_rand(0, $max)];
            if ($i == 0 && $temp == 0) {
                $unsetzero = str_replace('0', '', $uniqid);
                $temp      = $unsetzero[mt_rand(0, strlen($unsetzero))];
            }
            $hash .= $temp;
        }

        echo '<br>-------------------<br>';
        dump($hash);
        dump(substr(implode(null, array_map('ord', str_split(substr($uniqid, 7, 13), 1))), 0, 8));
        dump(random(11));
        dump(random(8, 5));
        echo 32;
        dump(random(64, 1));
        dump(random(50));
        echo '<br>-------------------<br>';
        die;

        $star = 7;
        dump($uniqid);
        dump(substr($uniqid, $star, 13));
        dump(str_split(substr($uniqid, $star, 13), 1));
        dump(array_map('ord', str_split(substr($uniqid, $star, 13), 1)));
        dump(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))));

        dump(substr(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))), 0, 8));
        dump(substr(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))), 0, 8));
        dump('-----------');
        dump(implode(null, array_map('ord', str_split(substr($uniqid, $star, 13), 1))));
        dump(str_split($uniqid));
        dump(array_map('ord', str_split($uniqid, 1)));
        dump(implode(null, array_map('ord', str_split($uniqid, 1))));
        dump('-----------');
    }

    // 登录首页
    public function index()
    {
        if (IS_POST) {

            if ($user = $this->model->validateLogin()) {
                // 设置登录错误记录的session为0
                session('error_num', 0);
                // 设置session
                $this->model->setSession($user);
                $this->model->updateLogin($user);

                // 登录日志记录
                action_log('manager_login', 'manager', $user['uid'], $user['uid']);

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
