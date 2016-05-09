<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  ActionLog.php[行为日志模型]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-09 14:54:31
 * @site      http://www.benweng.com
 */

namespace app\console\model;

use think\Model;

class ActionLog extends Model
{

    public function getStatusTextAttr($value, $data)
    {
        $status = [0 => '禁用', 1 => '正常'];
        return $status[$data['status']];
    }

}
