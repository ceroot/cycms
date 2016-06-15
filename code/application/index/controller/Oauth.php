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
 * @date      2016-06-15 11:40:59
 * @site      http://www.benweng.com
 */
namespace app\index\controller;

use think\Controller;
use third\ThinkSDK\ThinkOauth;

class Oauth extends Controller
{
    public function index()
    {
        dump(1);
    }

    public function login()
    {
        $type = input('get.type');
        if (empty($type)) {
            return $this->error('参数错误');
        }
        $sns = ThinkOauth::getInstance($type);
        $url = $sns->getRequestCodeURL();
        $this->redirect($url);
    }

    public function callback($type = null, $code = null)
    {
        if (empty($type)) {
            return $this->error('参数错误');
        }
        if (empty($code)) {
            return $this->error('参数错误');
        }

        $sns = ThinkOauth::getInstance($type);

        $extend = null;

        if ($type == 'tencent') {
            $extend = array('openid' => input('get.openid'), 'openkey' => input("get.openkey"));
        }
        // dump($sns);
        // die;
        $token = $sns->getAccessToken($code, $extend);
        // dump($token);
        die;
        $user_info = controller('type', 'event')->$type($token);
        dump($user_info);

        dump($type);
    }
}
