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

    public function login($type = null)
    {
        // $type = input('get.type');
        if (empty($type)) {
            return $this->error('参数错误');
        }
        $sns = ThinkOauth::getInstance($type);
        $url = $sns->getRequestCodeURL();
        $this->redirect($url);
    }

    public function dd($type = null)
    {
        dump(input('get.type'));
        dump(1);
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
        if (is_array($token)) {
            $user_info = controller('type', 'event')->$type($token);

            $user = $this->_login_handle($user_info, $type, $token);
            // dump($user_info);
            // dump($user);
        }

    }

    private function _login_handle($user_info, $type, $token)
    {
        $type = strtolower($type);
        $map  = [
            'type'   => $type,
            'openid' => $token['openid'],
        ];

        $oauth_user_sql = db('oauthUser')->where($map)->find();
        if ($oauth_user_sql) {
            dump('已经存在');
        } else {
            $data = array_merge($user_info, $token);

            $data['type']         = $type;
            $data['expires_time'] = $token['expires_in'];
            $data['head_img']     = $user_info['head'];

            unset($data['head']);
            unset($data['expires_in']);

            $status = model('oauthUser')->save($data);
            if ($status) {
                dump($status);
            } else {
                dump('失败');
            }
        }
        // dump($data);
        // return $user;
    }
}
