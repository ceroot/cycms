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
 * @date      2016-06-25 13:39:23
 * @site      http://www.benweng.com
 */

namespace app\console\controller;

class Attribute extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    protected $beforeActionList = [
        'add_before'  => ['only' => 'add'],
        'list_before' => ['only' => 'list'],
    ];

    protected function add_before()
    {
        $model_id = input('get.model_id');
        if (!$model_id) {
            return $this->error('缺少模型 id');
        }
    }

    protected function list_before()
    {
        // dump('before');
        // $model_id        = input('get.model_id');
        // $map['model_id'] = $model_id;
        // dump($map);
    }

    public function update($action_log = null)
    {
        dump('功能待完善');
    }
}
