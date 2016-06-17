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
 * @date      2016-06-17 17:44:07
 * @site      http://www.benweng.com
 */

namespace addons\oauth\controller;

use think\Controller;
use third\ThinkSDK\ThinkOauth;

class Oauth extends Controller
{

    public function index()
    {
        dump('这是第三方登录插件控制器');
    }

    public function login($type = null)
    {
        $type = input('type');
        dump($type);die;
        if (empty($type)) {
            return $this->error('参数错误');
        }
        $backurl = input('get.backurl');
        if ($backurl) {
            session('backurl', $backurl);
        } else {
            session('backurl', null);
        }

        $sns = ThinkOauth::getInstance($type);
        $url = $sns->getRequestCodeURL();
        $this->redirect($url);
    }

}
