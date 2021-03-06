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
 * @date      2016-06-05 17:40:53
 * @site      http://www.benweng.com
 */

namespace app\console\validate;

use think\Validate;

class DotWebinfo extends Validate
{

    protected $rule = [
        'title' => 'require',
    ];

    protected $message = [
        'title.require' => '标题必填',
    ];
}
