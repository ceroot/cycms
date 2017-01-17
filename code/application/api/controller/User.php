<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-18 07:51:02
 * @site      http://www.benweng.com
 */

namespace app\api\controller;

use think\Controller;

class User extends Controller
{
    public function logout()
    {
        session('uid', null);
        $url = url('index/index/test');
        return $this->success('注销成功', $url);
        // $this->redirect($url);
    }
}
