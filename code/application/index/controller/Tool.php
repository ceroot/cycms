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
 * @date      2016-06-19 20:12:32
 * @site      http://www.benweng.com
 */

namespace app\index\controller;

use think\Controller;

class Tool extends Controller
{

    public function daxiaoxie()
    {
        return $this->fetch();
    }

    public function t1()
    {
        return $this->fetch();
    }

    public function t2()
    {
        return $this->fetch();
    }

}
