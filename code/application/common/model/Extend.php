<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Extend.php[通用模型基础]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-19 00:50:49
 * @site      http://www.benweng.com
 */

namespace app\common\model;

use think\Model;

class Extend extends Model
{
    protected $insert = ['create_uid', 'create_ip'];
    protected $update = ['update_uid', 'update_ip'];

    public function setCreateUidAttr($value)
    {
        return UID;
    }

    public function setCreateIpAttr()
    {
        return ip2int();
    }

    public function setUpdateUidAttr($value)
    {
        return UID;
    }

    public function setUpdateIpAttr()
    {
        return ip2int();
    }

}
