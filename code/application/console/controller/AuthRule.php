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

        $rule = $this->model->getAll();
        // dump($rule);
        $this->assign('rule', $rule);
    }

    function list() {
        cookie('__forward__', $_SERVER['REQUEST_URI']); // 记录当前列表页的cookie
        return $this->fetch();
    }

    public function del()
    {
        $status = $this->model->del($this->id);

        if ($status) {

            $this->model->updateCache(); // 更新缓存
            action_log($this->id); // 记录日志
            return $this->success('成功');
        } else {
            return $this->error($this->model->getError());
        }
    }

    /**
     * @name   更新菜单显示
     * @author SpringYang <ceroot@163.com>
     */
    public function updateshow()
    {
        return $this->updatefield('isnavshow');
    }

    /**
     * @name   更新权限验证
     * @author SpringYang <ceroot@163.com>
     */
    public function updateauth()
    {
        return $this->updatefield('auth');
    }

    /**
     * @name   更新字段
     * @param  string   $string     [说明]
     * @return boolean              [返回布尔值]
     * @author SpringYang <ceroot@163.com>
     */
    protected function updatefield($field)
    {
        $status = db(CONTROLLER_NAME)->getFieldById($this->id, $field);

        $data[$field] = ($status == 1) ? 0 : 1;

        $status = $this->model->save($data, [$this->pk => $this->id]);

        if ($status) {
            $this->model->updateCache(); // 更新缓存
            $this->model->updateCacheAuthModel(); // 更新缓存

            action_log($this->id); // 记录日志
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }

    /**
     * @name   规则排序
     * @author SpringYang <ceroot@163.com>
     */
    public function sort()
    {
        if (request()->isAjax()) {
            $sortdata = input('post.sort/a');

            foreach ($sortdata as $key => $value) {
                $data['sort'] = $value;
                $this->model->save($data, ['id' => $key]);
            }

            $this->model->updateCache(); // 更新缓存
            action_log(UID); // 记录日志
            return $this->success('排序成功');
        } else {
            return $this->error('参数错误');
        }
    }

}
