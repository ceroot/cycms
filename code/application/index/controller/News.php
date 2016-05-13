<?php
namespace app\index\controller;

class News
{
    public function index()
    {
        return 'news';
    }

    public function hello()
    {
        dump('hello');
    }

    public function read($id = '')
    {
        dump($id);

        //dump(input('get.id'));
        dump(MODULE_NAME);
        dump(CONTROLLER_NAME);
        dump(ACTION_NAME);
        dump('read');

        // $url = url('blog/read?name=thinkphp');
        $url = url('news/read?id=65');
        dump($url);
        $url = url('console/index/index?time=' . time());
        dump($url);

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
