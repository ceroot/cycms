<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Action.php[行为表模型]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-28 15:46:30
 * @site      http://www.benweng.com
 */
namespace app\console\model;

use app\common\model\Extend;

class Action extends Extend
{
    public function getStatusTextAttr($value, $data)
    {
        $status = [0 => '禁用', 1 => '正常'];
        return $status[$data['status']];
    }

    public function getStatusHandleTextAttr($value, $data)
    {
        $status = [0 => '禁用', 1 => '启用'];
        return $status[$data['status']];
    }

    public function getTypeTextAttr($value, $data)
    {
        $status = [1 => '系统', 2 => '用户'];
        return $status[$data['type']];
    }

}
