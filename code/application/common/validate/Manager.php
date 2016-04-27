<?php
/**
 * 
 * 
 * @authors SpringYang
 * @email   ceroot@163.com
 * @date    2016-04-25 10:43:05
 * @site    http://www.benweng.com
 */
namespace app\common\validate;
use think\Validate;
class Manager extends Validate {
    
    protected $rule  = [
        // 'email'  => 'require|email',
    ];

    protected $message  = [
        // 'email.require'  => '必填',
        // 'email'          => '邮箱格式不正确'
    ];
}