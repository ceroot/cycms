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
 * @date      2016-06-03 11:50:42
 * @site      http://www.benweng.com
 */
namespace app\common\model;

use app\common\model\Extend;
use third\Data;

class DotCategory extends Extend
{
    public function getAll($isArray = 0)
    {
        $category = $this->select();
        if ($isArray) {
            return Data::channelLevel($category, 0, '', 'id', 'pid');
        } else {
            return Data::tree($category, 'title', 'id', 'pid');
        }
    }
}
