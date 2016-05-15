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

        if ($status) {
            // 记录日志
            $action = ACTION_NAME . '_' . strtolower(toCamel(CONTROLLER_NAME));
            action_log($action, CONTROLLER_NAME, $id, UID);

            if (CONTROLLER_NAME == 'auth_rule') {
                $this->model->updateCache(); // 更新缓存
                $this->model->updateCacheAuthModel(); // 更新缓存
            }

            $redata['status'] = 'success';
            $redata['info']   = '成功';
        } else {
            $redata['status'] = 'fail';
            $redata['info']   = $this->model->getError();
        }
        return $redata;
    }

    // 更新菜单显示
    public function updateshow()
    {
        return $this->updatefield('isnavshow');
    }

    // 更新菜单显示
    public function updateauth()
    {
        return $this->updatefield('auth');
    }

    // 更新字段
    protected function updatefield($field)
    {
        $pk     = $this->model->getPk();
        $id     = input('get.' . $pk);
        $status = db(CONTROLLER_NAME)->getFieldById($id, $field);

        $data[$field] = ($status == 1) ? 0 : 1;

        $status = $this->model->save($data, [$pk => $id]);

        if ($status) {
            // 记录日志
            $action = ACTION_NAME . '_' . strtolower(toCamel(CONTROLLER_NAME));
            action_log($action, CONTROLLER_NAME, $id, UID);

            $this->model->updateCache(); // 更新缓存
            $this->model->updateCacheAuthModel(); // 更新缓存

            $redata['status'] = 'success';
            $redata['info']   = '成功';
        } else {
            $redata['status'] = 'fail';
            $redata['info']   = '失败';
        }

        return $redata;
    }

}
