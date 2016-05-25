<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Action.php[规则表验证器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-05 22:52:30
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class Action extends Validate
{
    protected $rule = [
        'name'  => 'require|unique:action',
        'title' => 'require|unique:action',
    ];

    protected $message = [
        'name.require'  => '行为标识必填',
        'name.unique'   => '行为标识已存在',
        'title.require' => '行为标题必填',
        'title.unique'  => '行为标题已存在',
    ];

}
