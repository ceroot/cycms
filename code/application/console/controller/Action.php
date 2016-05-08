<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Action.php[用户行为控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-28 11:11:47
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;
use think\Db;

class Action extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();

    }

    public function log()
    {
        $list = Db::name('actionLog')->order('id', 'desc')->limit(10)->select();
        $this->assign('list', $list);
        return $this->fetch();
    }
}
