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
 * @date      2016-06-03 16:11:14
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class DotMenu extends Validate
{

    protected $rule = [
        'title' => 'require|unique:dotMenu',
        'name'  => 'require',
    ];

    protected $message = [
        'title.require' => '标题必填',
        'title.unique'  => '标题已经存在',
        'name.require'  => '内容必填',
    ];
}
