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

        if (!UID) {
            $redirecturl = url('console/login/index') . '?backurl=' . getbackurl();
            // $this->redirect('console/login/index');
            $this->error('请登录', $redirecturl);
            exit;
        }

        $manager = db('manager')->find(UID);

        // 锁定判断
        if ($manager['status'] == 0) {
            $redirecturl = url('console/login/index') . '?backurl=' . getbackurl();
            $this->error('账号被锁定，请联系管理员', $redirecturl);
            exit;
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
                $this->error('您没有相关权限');
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

        // 菜单输出
        $menu = model('AuthRule')->consoleMenu();
        $this->assign('menu', $menu); // 一级菜单输出
        $this->assign('second', $menu['second']); // 二级菜单输出
        $this->assign('title', $menu['showtitle']); // 标题输出
        $this->assign('bread', $menu['bread']); // 面包输出
        $this->assign('manager', $manager); // 管理员信息输出

    }

    public function basetest()
    {
        $data['auth']          = 1;
        $data['condition']     = '';
        $data['controller']    = 1;
        $data['instantiation'] = '';
        $data['isnavshow']     = 1;
        $data['name']          = 'category';
        $data['pid']           = 8;
        $data['sort']          = 100;
        $data['status']        = 1;
        $data['title']         = '类别管理';

        $this->model->data($data);
        $this->model->save();

        die;
        $action     = 'disable_authrule';
        $controller = 'authRule';
        $status     = 205;
        $uid        = 1;
        $stu        = action_log($action, $controller, $status, $uid);

        dump($stu);
    }

    public function index()
    {
        return $this->fetch();
    }

    function list() {
        $pageLimit = input('get.limit');
        $pageLimit = isset($pageLimit) ? $pageLimit : 10; // 每页显示数目
        $pk        = $this->model->getPk(); // 取得主键字段名

        $order = [
            $pk => 'desc',
        ];

        // 排序
        switch (CONTROLLER_NAME) {
            case 'auth_group':
                $order = [
                    $pk => 'asc',
                ];
                break;

            default:
                # code...
                break;
        }

        $data = $this->model->order($order)->paginate($pageLimit);

        // 获取分页显示
        $page = $data->render();
        $this->assign('page', $page);
        // $data = $this->_list();
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function add()
    {
        if (IS_AJAX) {
            $data = input('post.');
            // return $data;
            $result = $this->validate($data, CONTROLLER_NAME);
            return $data;
            if (true !== $result) {
                // 验证失败 输出错误信息
                $redata['status'] = 'fail';
                $redata['info']   = $result;
                return $redata;
            }

            $this->model->data($data);

            $status = $this->model->save($data);
            // return $data;
            if ($status) {
                // 记录日志
                $action = ACTION_NAME . '_' . strtolower(toCamel(CONTROLLER_NAME));
                action_log($action, CONTROLLER_NAME, $status, UID);

                if (CONTROLLER_NAME == 'auth_rule') {
                    $this->model->updateCache(); // 更新缓存
                    $this->model->updateCacheAuthModel(); // 更新缓存
                }

                $redata['status'] = 'success';
                $redata['info']   = '添加成功';
                $redata['url']    = url('list');

            } else {
                $redata['status'] = 'fail';
                $redata['info']   = '失败';
            }
            return $redata;
        } else {
            return $this->fetch();
        }
    }

    public function edit()
    {
        $pk = $this->model->getPk();
        if (IS_AJAX) {
            $data = input('post.');

            if (CONTROLLER_NAME == 'auth_group') {
                $rulesdata = input('post.rules/a');
                if ($rulesdata) {
                    $data['rules'] = implode(',', $rulesdata);
                } else {
                    $data['rules'] = '';
                }
                $data['id'] = input('post.id');

            }
            // return $data;
            $result = $this->validate($data, CONTROLLER_NAME);
            if (true !== $result) {
                // 验证失败 输出错误信息
                $redata['status'] = 'fail';
                $redata['info']   = $result;
                return $redata;
            }

            $status = $this->model->save($data, [$pk => $data[$pk]]);
            // return $data;
            if ($status) {
                // 记录日志
                $action = ACTION_NAME . '_' . strtolower(toCamel(CONTROLLER_NAME));
                action_log($action, CONTROLLER_NAME, $data[$pk], UID);

                if (CONTROLLER_NAME == 'auth_rule') {
                    $this->model->updateCache(); // 更新缓存
                    $this->model->updateCacheAuthModel(); // 更新缓存
                }

                $redata['status'] = 'success';
                $redata['info']   = '修改成功';
                $redata['url']    = url('list');

            } else {
                $redata['status'] = 'fail';
                $redata['info']   = '失败';
            }
            return $redata;
        } else {
            $id = input('get.' . $pk);
            if (!$id) {
                return '参数错误';
            } else {
                $one = db(CONTROLLER_NAME)->find($id);
                $this->assign('one', $one);
                return $this->fetch();
            }
        }
    }

    public function del()
    {
        $pk     = $this->model->getPk();
        $id     = input('get.' . $pk);
        $status = db(CONTROLLER_NAME)->delete($id);

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
            $redata['info']   = '失败';
        }
        return $redata;
    }

    // 更改 status 字段
    public function disable()
    {
        $pk          = $this->model->getPk();
        $id          = input('get.' . $pk);
        $statusValue = db(CONTROLLER_NAME)->getFieldById($id, 'status');

        $data['status'] = $statusValue == 1 ? 0 : 1;
        $status         = $this->model->save($data, [$pk => $id]);

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
            $redata['info']   = '失败';
        }
        return $redata;
    }

}
