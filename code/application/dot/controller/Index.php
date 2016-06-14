<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Index.php[首页控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-01 00:06:41
 * @site      http://www.benweng.com
 */
namespace app\dot\controller;

use app\dot\controller\Base;
use third\Data;

class Index extends Base
{
    public function _initialize()
    {
        parent::_initialize();

    }

    public function index()
    {
        $case = model('dotCases')->select();
        $this->assign('case', $case);

        $category = model('dotCategory')->where('display')->select();
        $category = Data::channelLevel($category, 0, '', 'id', 'pid');
        $this->assign('category', $category);
        return $this->fetch();
    }

    public function yctest()
    {
        dump(123);
    }
}
