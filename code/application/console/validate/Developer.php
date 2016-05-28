<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Developer.php[开发日志验证器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-28 12:35:54
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class Developer extends Validate
{
    protected $rule = [
        'title'   => 'require|unique:developer',
        'content' => 'require',
    ];

    protected $message = [
        'title.require'   => '标题必填',
        'title.unique'    => '标题已经存在',
        'content.require' => '内容必填',
    ];

}
