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
    public function getTypeTextAttr($value, $data)
    {
        $status = [1 => '系统', 2 => '用户'];
        return $status[$data['type']];
    }

    public function add_for_rule()
    {
        if (request()->isAjax()) {
            if (input('post._log')) {
                $name = input('post.name');

                $arr                = explode('/', $name);
                $name               = strtolower($arr[0] . '_' . $arr[1]);
                $title              = input('post.title');
                $data['title']      = $title;
                $data['name']       = $name;
                $data['create_uid'] = UID;
                $data['log']        = '[user|get_realname]在[time|time_format]操作了' . $title;

                $this->save($data);
            }
        }
    }

}
