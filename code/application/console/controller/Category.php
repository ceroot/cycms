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
use third\Data;

class Category extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
        $category = db(request()->controller())->select();
        $category = Data::tree($category, 'title', 'id', 'pid');
        $this->assign('category', $category);
    }
    /**
     *
     */
    function list() {
        cookie('__forward__', $_SERVER['REQUEST_URI']); // 记录当前列表页的cookie
        return $this->fetch();
    }
    // 更新显示状态
    public function updatedisplay()
    {
        $pk              = $this->model->getPk();
        $id              = input('get.' . $pk);
        $value           = db(request()->controller())->getFieldById($id, 'display');
        $data['display'] = ($value == 1) ? 0 : 1;
        $status          = $this->model->save($data, [$pk => $id]);
        if ($status) {
            action_log($id); // 记录日志
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }
    public function ctest()
    {
        parent::ctest();
        dump($category);
        return $category;
    }
}
