<?php
namespace app\index\controller;

use think\Controller;

class UserInfo extends Controller
{
    public function index()
    {
        dump(url('UserInfo'));
        // return $this->fetch();
    }

}
