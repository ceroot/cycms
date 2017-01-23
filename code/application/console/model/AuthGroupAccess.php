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
    /**
     * @name   saveData             [保存数据]
     * @author SpringYang <ceroot@163.com>
     */
    public function saveData($uid)
    {
        $this->delDataByUid($uid); // 先删除原有的

        $group_id = input('param.group_id/a');
        $group_id = array_unique($group_id);
        $data     = array();
        foreach ($group_id as $value) {
            $one['uid']      = $uid;
            $one['group_id'] = $value;
            $data[]          = $one;
        }
        $this->saveall($data);
    }

    /**
     * @name   delDataByUid         [根据用户id删除数据]
     * @param  string   $uid        [用户id]
     * @return boolean              [返回布尔值]
     * @author SpringYang <ceroot@163.com>
     */
    public function delDataByUid($uid)
    {
        $this->where('uid', $uid)->delete();
    }

    /**
     * @name   delDataByUid         [根据角色id删除数据]
     * @param  string   $gid        [角色id]
     * @return boolean              [返回布尔值]
     * @author SpringYang <ceroot@163.com>
     */
    public function delDataByGid($gid)
    {
        $this->where('group_id', $gid)->delete();
    }

}
