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
 * @date      2016-06-24 11:21:00
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;
use third\Data;

class Area extends Base
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
        $data = $this->model->where('pid', 0)->select();
        $list = Data::tree($data, 'name', 'id', 'pid');
        // dump($list);
        $this->assign('list', $list);
        return $this->fetch();
    }

}
