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
 * @date      2016-06-03 14:56:52
 * @site      http://www.benweng.com
 */
namespace app\dot\model;

use app\common\model\Extend;

class Cases extends Extend
{
    protected $table = 'cy_dot_cases';

    public function getone()
    {
        $id = input('get.id');
        return $this->find($id);
    }
}
