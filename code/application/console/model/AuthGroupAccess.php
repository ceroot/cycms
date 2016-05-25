<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  AuthGroupAccess.php[]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-25 09:42:25
 * @site      http://www.benweng.com
 */
namespace app\console\model;

use think\Model;

class AuthGroupAccess extends Model
{

    public function saveData($uid)
    {
        $this->where('uid', $uid)->delete();

        $group_id = input('post.group_id/a');
        $group_id = array_unique($group_id);
        $data     = array();
        foreach ($group_id as $value) {
            $one['uid']      = $uid;
            $one['group_id'] = $value;
            $data[]          = $one;
        }
        $this->saveall($data);
    }
}
