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
 * @date      2016-06-25 18:49:16
 * @site      http://www.benweng.com
 */

namespace app\common\model;

class Document extends Extend
{
    public function getCreateTimeAttr($value)
    {
        return date('Y-m-d H:i', $value);
    }
}
