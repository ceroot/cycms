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
        // echo 'init<br/>';
        // return '测试';
        $this->model = model('manager');

    }

    public function yctest()
    {
        // $this->model->updateLogin(1);
        // Manager::where('uid', 1)->update(['times' => '120']);
        // die;
        // $manager        = Manager::get(1);
        // $manager->times = 120;
        // $manager->save();

        // die;
        $manager        = new Manager;
        $manager->id    = 1;
        $manager->times = 120;
        $manager->save();
    }

    // 登录首页
    public function index()
    {
        // dump(md5('ceroot1'));

        if (IS_POST) {

            if ($user = $this->model->validateLogin()) {
                // $redata  = $user;
                // 设置登录错误记录的session为0
                session('error_num', 0);
                // 设置session
                $this->model->setSession($user);
                $this->model->updateLogin($user);

                // 登录日志记录
                $uid = session('userid');
                action_log('manager_login', 'manager', $uid, $uid);

                $redata = array('status' => 1, 'info' => '登录成功', 'url' => url('Index/index'), 'error_num' => 0);
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

            // $view  = new \think\View(\think\Config::get());
            // return $view->fetch();
            return $this->fetch();
        }
    }

    // 退出方法
    public function loginout()
    {

        session('userid', null);
        session('username', null);
        session('nickname', null);

        return $this->success('注销成功', '/console/index/index');
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
        // $dd  = new \third\Yctest();
        // $data = $dd->sayHello();
        // dump($data);
        // die;

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
