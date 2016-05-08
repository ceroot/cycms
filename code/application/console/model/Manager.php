<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Manager.php[管理员表模型]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-03-29 17:41:58
 * @site      http://www.benweng.com
 */

namespace app\console\model;

use think\Model;

class Manager extends Model
{
    protected $pk = 'uid';

    // 自动完成
    protected $auto          = [];
    protected $autoTimeField = ['create_time', 'login_time', 'update_time'];
    protected $insert        = ['create_time', 'create_ip'];
    protected $update        = ['login_time', 'login_ip'];

    public function setLoginIpAttr($value)
    {
        return ip2int();
    }

    public function setCreateIpAttr($value)
    {
        return ip2int();
    }

    // public function __construct()
    // {
    //     // $ddd = 0;
    // }

    /**
     * [validate_login 验证登录]
     * @return [type] [description]
     */
    public function validateLogin()
    {
        /******接收数据******/
        $username = input('post.username');
        $password = input('post.password');
        $code     = input('post.verify');

        // 用户名不为空
        if (!$username || $username == '请输入用户名') {
            $this->error = '请输入用户名';
            return false;
        }

        // 密码不为空
        if (!$password) {
            $this->error = '请输入密码';
            return false;
        }

        $error_num = session('error_num');
        if (!isset($error_num)) {
            session('error_num', 0);
        }

        // 验证码验不为空
        if ($error_num > 3 && !$code) {
            $this->error = '请输入验证码';
            return false;
        }

        // 验证码是否相等
        if ($error_num > 3 && !verifyCheck($code)) {
            $this->error = '验证码输入错误';
            return false;
        }

        $user = db('manager')->where('username', $username)->find();
        return $user;
        if (!$user) {
            $this->error = '用户名不存在';
            session('error_num', $error_num + 1);
            return false;
        }

        if ($user['password'] != md5($username . $password)) {
            $this->error = '密码错误';
            session('error_num', $error_num + 1);
            return false;
        }

        if ($user['status']) {
            $this->error = '用户锁定中，请联系管理员';
            return false;
        }

        $auto = input('post.auto');
        if ($auto) {
            setcookie(session_name(), session_id(), time() + 60 * 60 * 24 * 14, '/');
        } else {
            setcookie(session_name(), session_id(), 0, '/');
        }

        return $user;
    }

    /**
     * [set_session set_session]
     * @param [type] $user [description]
     */
    public function setSession($user)
    {
        session('userid', $user['uid']);
        session('username', $user['username']);
        session('nickname', $user['nickname']);
    }

    /**
     * [update_login 更新登录信息]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function updateLogin($user)
    {
        // 更新登录信息
        $data['times'] = $user['times'] + 1;
        $manager       = model('manager');
        $manager->save($data, ['uid' => $user['uid']]);
    }

}
