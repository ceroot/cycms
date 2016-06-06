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
 * @date      2016-06-06 11:48:26
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class DotArticle extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
        $category = model('dotCategory')->getAll();
        $this->assign('category', $category);
        // dump($category);
    }

    protected $beforeActionList = [
        'add_before'  => ['only' => 'add'],
        'edit_before' => ['only' => 'edit'],
    ];

    protected function add_before()
    {
        $cid = input('cid');
        if ($cid == '-1') {
            return $this->error('请选择分类');
        }
    }

    protected function edit_before()
    {
        $cid = input('cid');
        if ($cid == '-1') {
            return $this->error('请选择分类');
        }
    }

}
