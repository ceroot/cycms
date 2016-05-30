<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {

        return 'index';
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
