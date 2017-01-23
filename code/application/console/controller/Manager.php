<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Manager.php[管理员控制器]
 * @authors SpringYang
 * @email   ceroot@163.com
 * @QQ      525566309
 * @date    2016-04-28 11:11:47
 * @site    http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class Manager extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
        if (request()->action() == 'edit') {
            $data['password'] = md5(input('unsername') . input('password'));
        }

        $groupdata    = db('authGroup')->where('status', 1)->field('id,title,status,describe')->select();
        $authgroup    = db('AuthGroupAccess')->where('uid', input('param.id'))->select();
        $newgroupdata = [];
        foreach ($groupdata as $key => $value) {
            $value['select'] = 0;
            foreach ($authgroup as $k => $v) {
                if ($value['id'] == $v['group_id']) {
                    $value['select'] = 1;
                }
            }
            $newgroupdata[] = $value;
        }
        $this->assign('newgroupdata', $newgroupdata);
        // dump($newgroupdata);
        // die;
        // $this->assign('groupdata', $groupdata);
        // $this->assign('authgroup', $authgroup);

        // dump($authgroup);
        // dump($groupdata);
        // die;

    }

    protected $beforeActionList = [
        // 'first',
        // 'second' => ['except' => 'hello'],
        'three'        => ['only' => 'hello,data'],
        '_before_add'  => ['only' => 'add'],
        '_before_edit' => ['only' => 'edit'],
    ];

    protected $afterActionList = [
        '_atfer_add'  => ['only' => 'add'],
        '_atfer_edit' => ['only' => 'edit'],
    ];

    protected function _before_edit()
    {
        session('after', 'aftertest');
    }

    protected function _after_edit()
    {
        session('after', 'aftertest');
    }

    protected function first()
    {
        echo 'first<br/>';
    }

    protected function second()
    {
        echo 'second<br/>';
    }

    protected function three()
    {
        echo 'three<br/>';
    }

    protected function _before_add()
    {

    }

    public function hello()
    {
        return 'hello';
    }

    public function data()
    {
        return 'data';
    }

    public function info()
    {
        if (request()->isAjax()) {
            $data   = input('post.');
            $status = $this->model->validate(request()->controller() . '.info')->save($data, ['id' => $data['id']]);
            if ($status === false) {
                return $this->error($this->model->getError());
            }

            if ($status) {
                action_log($data['id']); // 记录操作日志
                return $this->success('个人信息修改成功');
            } else {
                return $this->error('个人信息修改失败');
            }
            return $data;
        } else {
            $one = $this->model->find(UID);
            $this->assign('one', $one);
            return $this->fetch();
        }
    }

    public function change()
    {
        $one = $this->model->find(UID);
        $this->assign('one', $one);
        return $this->fetch();
    }

    /**
     * @name   password             [修改密码]
     * @return boolean              [返回布尔值]
     * @author SpringYang <ceroot@163.com>
     */
    public function password()
    {
        if (request()->isAjax()) {
            $data     = input('post.');
            $username = $this->model->getFieldById($data['id'], 'username');

            $data['password']   = encrypt_password($data['password'], $data['hash']);
            $data['repassword'] = encrypt_password($data['password_confirm'], $data['hash']);

            $status = $this->model->validate(request()->controller() . '.password')->save($data, ['id' => $data['id']]);
            if ($status === false) {
                return $this->error($this->model->getError());
            }

            if ($status) {
                action_log($data['id']); // 记录操作日志
                return $this->success('修改密码成功');
            } else {
                return $this->error('修改密码失败');

            }

        } else {
            $one = $this->model->find(UID);
            $this->assign('one', $one);
            return $this->fetch();
        }
    }

}
