<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Base.php[基础控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-01 00:50:03
 * @site      http://www.benweng.com
 */

namespace app\dot\controller;

use app\common\controller\Extend;

class Base extends Extend
{
    public function _initialize()
    {
        $menu = db('dotMenu')->select();
        $this->assign('menu', $menu);
        $webinfo = db('dotWebinfo')->find(1);
        $this->assign('webinfo', $webinfo);
    }

    public function index()
    {
        return $this->fetch();
    }
}
