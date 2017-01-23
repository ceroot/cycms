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
        'username'         => 'require|min:2|unique:manager',
        'password'         => 'require|min:6|max:18|confirm',
        'password_confirm' => 'require',
        'nickname'         => 'unique:manager',
        'email'            => 'email',
    ];

    protected $message = [
        'username.require'         => '用户名必须',
        'username.unique'          => '用户名已经存在',
        'username.min'             => '用户名长大要大于2',
        'password.require'         => '密码必填',
        'password.min'             => '密码长度必须大于等于6',
        'password.max'             => '密码长度过长',
        'password.confirm'         => '确认密码不正确',
        'password_confirm.require' => '确认密码必须',
        // 'nickname.require'   => '昵称必填',
        'nickname.unique'          => '昵称已经存在',
        'email'                    => '邮箱格式不正确',
    ];

    protected $scene = [
        'add'      => ['username', 'password'],
        'edit'     => ['username', 'password'],
        'password' => ['password', 'password_confirm'],
        'info'     => ['nickname', 'email'],
    ];

}
