<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {

        return $this->fetch();
    }

    public function test()
    {
        echo '控制器：（CONTROLLER_NAME）';
        dump(CONTROLLER_NAME);
        echo '<hr>';
        echo '时间：（NOW_TIME）';
        dump(NOW_TIME);
        echo '<hr>';
        echo '控制器：request()->controller()';
        dump(request()->controller());
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
