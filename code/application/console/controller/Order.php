<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Base.php[控制台基础控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-21 14:02:52
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

// use think\Controller;

class Order extends Base
{

    public function index()
    {
        // // return 'main';
        // $view = new \think\View();
        //    return $view->fetch('index');

        return $this->fetch();
    }

    public function index2()
    {
        // return 'main';

        return $this->fetch();
    }

    public function index3()
    {
        return $this->fetch();
    }
    public function index4()
    {
        return $this->fetch();
    }
    public function index5()
    {
        return $this->fetch();
    }
    public function index6()
    {
        return $this->fetch();
    }
    public function index7()
    {
        return $this->fetch();
    }

    public function index8()
    {
        return view('admin@index/index');
    }
}
