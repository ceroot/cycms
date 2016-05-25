<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  AuthGroup.php[角色控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-08 16:08:59
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class AuthGroup extends Base
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
        $pageLimit = input('get.limit');
        $pageLimit = isset($pageLimit) ? $pageLimit : 5; // 每页显示数目
        $pk        = $this->model->getPk(); // 取得主键字段名

        $order = [
            $pk => 'asc',
        ];

        $list      = $this->model->order($order)->paginate($pageLimit);
        $page      = $list->render();
        $rulesTree = $this->model->getRules($list);

        $this->assign('list', $rulesTree);
        $this->assign('page', $page);
        return $this->fetch();
    }

    public function rule()
    {
        $rules = model('authRule')->getAll(1);
        $this->assign('rules', $rules);

        $field = db('authGroup')->find(input('get.id'));
        $this->assign('field', $field);
        return view();
    }

}
