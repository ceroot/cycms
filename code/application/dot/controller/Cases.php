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
 * @date      2016-06-03 14:54:24
 * @site      http://www.benweng.com
 */
namespace app\dot\controller;

use app\dot\controller\Base;

class Cases extends Base
{

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    function list() {

    }

    public function view()
    {
        $id  = input('get.id');
        $one = model('cases')->find($id);
        $this->assign('one', $one);
        return $this->fetch();
    }
}
