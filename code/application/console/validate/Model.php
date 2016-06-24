<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-24 15:50:13
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class Model extends Validate
{

    protected $rule = [
        'name'  => 'require|unique:model',
        'title' => 'require',
    ];

    protected $message = [
        'name.require'  => '模型标识必须',
        'name.unique'   => '模型标识已存在',
        'title.require' => '模型名称必须',
    ];
}
