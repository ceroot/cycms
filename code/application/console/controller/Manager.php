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
use app\console\model\Manager;
use think\Db;

class Manager extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();

    }

    public function log()
    {
        $list = Db::name('actionLog')->order('id desc')->select();

        $this->assign('list', $list);
        return $this->fetch();
    }

    public function yctest()
    {
        // $this->model->updateLogin(1);
        // die;
        // // Manager::where('uid', 1)->update(['times' => '121']);
        // // die;

        // $manager        = new Manager;
        // $manager        = model('manager');
        // $manager->uid   = 1;
        // $manager->times = 122;
        // $manager->save();

        $manager = Manager::get(1);
        $manager = model('manager')->get(1);
        dump($manager);
        die;
        $manager->times = '129';
        $manager->save();

        // $manager = new Manager;
        // $manager->save(['times' => '128'], ['uid' => 1]);
    }
}
