<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Base.php[控制台基础控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-27 11:10:25
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\common\controller\Extend;

class Base extends Extend
{

    protected $model;

    public function _initialize()
    {

        // 定义UID
        define('UID', session('userid'));

        // $db = db('manager');
        // dump($db);
        // $data = $db->select();
        // dump($data);
        // $db = \think\Db::name('manager');
        // dump($db);
        // $data = $db->select();
        // dump($data);
        // die;

        if (!UID) {
            $this->redirect('console/login/index');
            exit;
        }

        $manager = db('manager')->find(UID);
        // dump($manager);

        // 锁定判断
        if ($manager['status'] == 1) {
            $this->redirect('console/login/index');
        }

        // 生成不需要进行权限验证的和不需要实例化模型的控制器缓存
        if (!cache('authModel')) {
            model('authRule')->updateCacheAuthModel();
        }

        // 读取不需要进行权限验证的和不需要实例化模型的控制器缓存
        $authModel = cache('authModel');

        if (ACTION_NAME) {
            $authName = CONTROLLER_NAME . '/' . ACTION_NAME;
        } else {
            $authName = CONTROLLER_NAME;
        }

        // 验证权限
        // 满足条件
        // 1 不是超级管理员
        // 2 是必须验证的
        if (!in_array(UID, config('auth_superadmin')) && !in_array($authName, $authModel['not_auth'])) {

            // 处理会员和管理员规则
            $controller = CONTROLLER_NAME;
            if ($controller == 'User' && I('role') == 1) {
                $controller = 'manager';
            }

            // 权限验证
            $authName = $controller . '/' . ACTION_NAME;
            // 执行验证
            if (!authCheck($authName, UID)) {
                // 提示
                // $this->assign('message','您没有相关权限');
                // $this->display('./Data/Public/notice/auth.html');
                // return $this->error('您没有相关权限');
                // return $this->error('您没有相关权限');
                //return $this->error('您没有相关权限');
                echo '您没有相关权限';
                // $this->error('您没有相关权限');
                // return false;
                exit;
            }

        }

        define('CONTROLLER_ACTION', strtolower(CONTROLLER_NAME . '/' . ACTION_NAME));

        // 取得控制器名称
        $controllerName = CONTROLLER_NAME;

        if (!in_array($controllerName, $authModel['not_d_controller'])) {
            $this->model = model($controllerName);
        }
        // dump(1);
        // die;

        // 菜单输出
        $menu = model('AuthRule')->adminMenu();
        // dump($menu['showtitle']);

        // die;
        $this->assign('menu', $menu);

        $this->assign('second', $menu['second']);

        $this->assign('title', $menu['showtitle']);

        $this->assign('bread', $menu['bread']);

        // 管理员信息输出
        $this->assign('manager', $manager);

    }

    public function basetest()
    {

        $status = $this->model->test();
        dump($status);
    }

    public function index()
    {
        return $this->fetch();
    }

    function list() {
        $data = $this->_list();
        // dump($data);
        // die;
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function _list()
    {
        $pk = $this->model->getPk();

        $data = $this->model::scope(function ($query) use ($pk) {
            $query->order($pk, 'desc');
        })->all();

        return $data;
    }

    public function add()
    {
        if (IS_AJAX) {
            $data = input('post.');

            $result = $this->validate($data, CONTROLLER_NAME);
            if (true !== $result) {
                // 验证失败 输出错误信息
                $redata['status'] = 'fail';
                $redata['info']   = $result;
                return json_encode($redata);
            }

            $this->model->data($data);
            $status = $this->model->save($data);
            // return json_encode($data);
            if ($status) {
                $model     = strtolower(toCamel(CONTROLLER_NAME));
                $action    = ACTION_NAME . '_' . $model;
                $record_id = getRecordId($action);

                if ($record_id) {
                    action_log($action, $model, $record_id, UID);
                }

                if (CONTROLLER_NAME == 'auth_rule') {
                    $this->model->updateCache(); // 更新缓存
                    $this->model->updateCacheAuthModel(); // 更新缓存
                }

                $redata['status'] = 'success';
                $redata['info']   = '成功';

            } else {
                $redata['status'] = 'fail';
                $redata['info']   = '失败';
            }
            return $redata;
            // return json_encode($redata);

        } else {
            return $this->fetch();
        }
    }

    public function addhan()
    {
        $data = input('post.');
        $this->model->save($data);
    }

    public function edit()
    {
        $pk = $this->model->getPk();
        if (IS_AJAX) {
            $data   = input('post.');
            $status = $this->model->save($data, [$pk => $data[$pk]]);
            if ($status) {

                $model     = strtolower(toCamel(CONTROLLER_NAME));
                $action    = ACTION_NAME . '_' . $model;
                $record_id = getRecordId($action);

                if ($record_id) {
                    action_log($action, $model, $record_id, UID);
                }

                if (CONTROLLER_NAME == 'auth_rule') {
                    $this->model->updateCache(); // 更新缓存
                    $this->model->updateCacheAuthModel(); // 更新缓存
                }

                $redata['status'] = 'success';
                $redata['info']   = '成功';

            } else {
                $redata['status'] = 'fail';
                $redata['info']   = '失败';
            }
            return $redata;
            // return json_encode($redata);
        } else {

            $id   = input('get.' . $pk);
            $data = db(CONTROLLER_NAME)->find($id);
            $this->assign('one', $data);
            return $this->fetch();
        }
    }

    public function del()
    {

        $pk = $this->model->getPk();
        // dump($pk);

        $id = input('get.' . $pk);
        // dump($id);
        // die;
        $status = db(CONTROLLER_NAME)->delete($id);

        if ($status) {
            $redata['status'] = 'success';
            $redata['info']   = '成功';
        } else {
            $redata['status'] = 'fail';
            $redata['info']   = '失败';
        }
        return $redata;
        // return json_encode($redata);
    }

    public function upcache()
    {
        $pk = model(CONTROLLER_NAME)->getPk();
        dump($pk);

        model(CONTROLLER_NAME)->updateCache();
    }

}
