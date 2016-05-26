<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  AuthGroup.php[角色表验证器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-08 21:15:10
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class AuthGroup extends Validate
{
    protected $rule = [
        'title' => 'require|unique:authGroup',
    ];
    protected $message = [
        'title.require' => '角色名称必须',
        'title.unique'  => '角色名称已存在',
    ];
    protected $scene = [''];
}
