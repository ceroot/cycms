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

    protected $beforeActionList = [
        'add_before' => ['only' => 'add'],
    ];

    protected function add_before()
    {
        if (input('get.pid')) {
            $this->assign('pid', input('get.pid'));
        }
    }

    function list() {
        return $this->fetch();
    }

    public function updatedisplay()
    {
        $pk = $this->model->getPk();
        $id = input('get.' . $pk);

        if (!$id) {
            return $this->error('参数错误');
        }

        $value           = db(CONTROLLER_NAME)->getFieldById($id, 'display');
        $data['display'] = $value ? 0 : 1;
        $status          = $this->model->save($data, [$pk => $id]);
        if ($status) {
            action_log($id); // 记录日志
            return $this->success('成功');
        } else {
            // return $this->error('失败');
            return $this->model->getError();
        }

    }

}
