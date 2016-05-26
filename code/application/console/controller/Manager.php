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
        if (ACTION_NAME == 'edit') {
            $data['password'] = md5(input('unsername') . input('password'));
        }

        $groupdata = db('authGroup')->select();
        $this->assign('groupdata', $groupdata);
        $authgroup = db('AuthGroupAccess')->where('uid', input('get.id'))->select();
        $this->assign('authgroup', $authgroup);
        // dump($authgroup);
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
        $one = $this->model->find(UID);

        return $this->fetch();
    }

    public function change()
    {
        $one = $this->model->find(UID);
        $this->assign('one', $one);
        return $this->fetch();
    }

}
