<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Category.php[类别控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-19 00:23:43
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class Category extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();

        $category = $this->model->getAll();
        $this->assign('category', $category);

    }

    public function ctest()
    {
        parent::ctest();
        dump($category);
        return $category;
    }
}
