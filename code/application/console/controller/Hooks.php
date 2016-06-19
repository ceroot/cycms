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
 * @date      2016-06-18 14:00:26
 * @site      http://www.benweng.com
 */

namespace app\console\controller;

use app\console\controller\Base;

class hooks extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 钩子列表
     */
    public function hooks()
    {
        $this->meta_title = '钩子列表';
        $map              = $fields              = array();
        $list             = $this->lists(D("Hooks")->field($fields), $map);
        int_to_string($list, array('type' => C('HOOKS_TYPE')));
        // 记录当前列表页的cookie
        Cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->assign('list', $list);
        $this->display();
    }
}
