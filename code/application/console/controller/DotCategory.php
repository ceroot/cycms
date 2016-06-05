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
 * @date      2016-06-03 16:13:45
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class DotCategory extends Base
{

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
        $category = model('dotCategory')->getAll();
        // dump($category);
        $this->assign('category', $category);
    }

    function list() {
        return $this->fetch();
    }

    protected $beforeActionList = [
        'add_before' => ['only' => 'add'],
    ];

    protected function add_before()
    {
        if (input('get.pid')) {
            $this->assign('pid', input('get.pid'));
        }
    }

}
