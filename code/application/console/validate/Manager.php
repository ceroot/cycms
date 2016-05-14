<?php
/**
 *
 *
 * @authors SpringYang
 * @email   ceroot@163.com
 * @date    2016-04-25 10:43:05
 * @site    http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class Manager extends Validate
{

    protected $rule = [
        // 'email'  => 'require|email',
        'username' => 'require|unique:manager',
        'password' => 'require',
    ];

    protected $message = [
        // 'email.require'  => '必填',
        // 'email'          => '邮箱格式不正确'
        'username.require' => '用户名必须',
        'username.unique'  => '用户名已经存在',
        'password.require' => '密码必填',
    ];

    protected $scene = [
        'edit' => ['username'],
    ];
}
