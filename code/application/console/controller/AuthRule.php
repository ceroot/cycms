<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  AuthRule.php[权限控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-27 11:10:25
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class AuthRule extends Base
{
    public $model;

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();

        $data = $this->model->getAll();
        $this->assign('data', $data);

    }

    function list() {
        return $this->fetch();
    }

    public function del()
    {

        $id = input('get.id');

        $status = $this->model->del($id);
        // return $status;
        // // dump($status);
        // if ($status) {
        //     dump('成功');
        // } else {
        //     dump($this->model->getError());
        // }
        if ($status) {
            $redata['status'] = 'success';
            $redata['info']   = '成功';
        } else {
            $redata['status'] = 'fail';
            $redata['info']   = $this->model->getError();
        }
        return json_encode($redata);
    }

}
