<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Manager.php[管理员验证器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-25 10:43:05
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class Manager extends Validate
{
    protected $rule = [
        'username'   => 'require|unique:manager',
        'password'   => 'require|confirm:repassword',
        'repassword' => 'require',
        'nickname'   => 'unique:manager',
        'email'      => 'email',
    ];

    protected $message = [
        'username.require'   => '用户名必须',
        'username.unique'    => '用户名已经存在',
        'password.require'   => '密码必填',
        'password.confirm'   => '确认密码不正确',
        'repassword.require' => '确认密码必须',
        // 'nickname.require'   => '昵称必填',
        'nickname.unique'    => '昵称已经存在',
        'email'              => '邮箱格式不正确',
    ];

    protected $scene = [
        'add'      => ['username', 'password'],
        'edit'     => ['username'],
        'password' => ['password', 'repassword'],
        'info'     => ['nickname', 'email'],
    ];

}
