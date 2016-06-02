<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
//         dump(request()->module());
        //         dump(request()->controller());
        //         dump(request()->action());
        // //         request()->module();//取得模块名称
        //         // request()->controller()//;取得控制器名称
        //         // request()->action();//取得方法名称
        //         // dump(CONTROLLER_LAYER);
        //         return 'index';
        return $this->fetch();
    }

    public function hello()
    {
        $qin = new \think\auth\Qin();
        $qin = $qin->hello();
        dump(qin());
    }

    public function zs()
    {
        dump('zs');
    }

    public function ls()
    {
        dump('ls');
    }
}
