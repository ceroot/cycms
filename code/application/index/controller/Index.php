<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return 'index';
    }

    public function hello($name = 'World')
    {
        return 'Hello,' . $name . '！';
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
