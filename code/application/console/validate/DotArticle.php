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
 * @date      2016-06-06 11:50:11
 * @site      http://www.benweng.com
 */
namespace app\console\validate;

use think\Validate;

class DotArticle extends Validate
{

    protected $rule = [
        'cid'     => 'require',
        'title'   => 'require',
        'content' => 'require',
    ];

    protected $message = [
        'cid.require'     => '请选择分类',
        'title.require'   => '标题必填',
        'content.require' => '内容必填',
    ];
}
