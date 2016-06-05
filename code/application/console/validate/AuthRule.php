<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  AuthRule.php[规则表验证器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-03 14:50:33
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class AuthRule extends Validate
{
    protected $rule = [
        'name'  => 'require|unique:authRule',
        'title' => 'require',
    ];

    protected $message = [
        'name.require'  => '用户名必须',
        'name.unique'   => '规则标识已存在',
        'title.require' => '规则名称必须',
    ];

    protected $scene = [
        'edit' => ['name', 'title'],
    ];

}
