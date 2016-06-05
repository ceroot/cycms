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
 * @date      2016-06-05 17:18:27
 * @site      http://www.benweng.com
 */

namespace app\console\controller;

use app\console\controller\Base;

class DotWebinfo extends Base
{

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        return $this->fetch();
    }

    public function edit()
    {
        if (request()->isAjax()) {
            $data = input('post.');
            $pk   = $this->model->getPk();

            $status = $this->model->save($data, [$pk => $data[$pk]]);
            // return $status;
            if ($status) {
                action_log($data[$pk]); // 记录日志
                return $this->success('修改成功', url('index'));
            } else {
                return $this->error('失败');
                // return $this->model->getError();
            }
        } else {
            $one = db('dotWebinfo')->find(1);
            $this->assign('one', $one);
            return $this->fetch();
        }

    }
}
