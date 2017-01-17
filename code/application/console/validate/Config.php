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
 * @date      2016-06-19 16:15:35
 * @site      http://www.benweng.com
 */

namespace app\console\validate;

use think\Validate;

class Config extends Validate
{
    protected $rule = [
        'name'  => 'require|unique:category',
        'title' => 'require|unique:category',
    ];

    protected $message = [
        'name.require'  => '分类标识必填',
        'name.unique'   => '分类标识已存在',
        'title.require' => '分类名称必填',
        'title.unique'  => '分类名称已存在',
    ];

    protected $scene = [
        // 'add'  => [''],
        // 'edit' => [''],
    ];

}
