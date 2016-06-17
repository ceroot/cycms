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

    public function login()
    {
        $type = input('type');
        // dump($type);die;
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

    public function callback($type = null, $code = null)
    {
        $type = input('type');
        $code = input('code');
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

        $token = $sns->getAccessToken($code, $extend);

        if (is_array($token)) {
            $user_info = controller('type', 'event')->$type($token);
            // dump($user_info);
            // dump($token);

            $user = $this->_login_handle($user_info, $type, $token);
        }

    }

    private function _login_handle($user_info, $type, $token)
    {
        $type = strtolower($type);
        $map  = [
            'type'          => $type,
            'openid'        => $token['openid'],
            'status'        => 1,
            'delete_status' => 1,
        ];

        $oauth_user_sql = db('oauthUser')->where($map)->find();
        if ($oauth_user_sql) {
            dump('已经存在');
            $id                 = $oauth_user_sql['id'];
            $data['update_uid'] = $id;
            $data['times']      = $oauth_user_sql['times'] + 1;

            // 判断 name 值是否相等
            if ($oauth_user_sql['name'] != $user_info['name']) {
                $data['name'] = $user_info['name'];
            }

            // 判断 nick 值是否相等
            if ($oauth_user_sql['nick'] != $user_info['nick']) {
                $data['nick'] = $user_info['nick'];
            }

            // 保存数据
            $status = model('oauthUser')->save($data, ['id' => $id]);
            if ($status) {
                // 判断是否绑定本平台用户
                if ($oauth_user_sql['uid']) {
                    session('uid', $oauth_user_sql['uid']);
                } else {
                    session('uid', $id);
                }

                $backurl = session('backurl');
                if ($backurl) {
                    $url = $backurl;
                    session('backurl', null);
                } else {
                    $url = url('index/index/test');
                }
                $this->redirect($url);
            } else {
                dump('登录失败');
                $url = url('index/index/test');
                $this->redirect($url);
            }
        } else {
            $data = array_merge($user_info, $token);

            $data['type']         = $type;
            $data['expires_time'] = $token['expires_in'];
            $data['head_img']     = $user_info['head'];
            $data['times']        = 1;

            unset($data['head']);
            unset($data['expires_in']);

            $status = model('oauthUser')->save($data);
            if ($status) {
                dump('写入成功');
                session('uid', $status);
                $backurl = session('backurl');
                if ($backurl) {
                    $url = $backurl;
                    session('backurl', null);
                } else {
                    $url = url('index/index/test');
                }
            } else {
                dump('登录失败');
            }
        }

    }

    public function logout()
    {
        session('uid', null);
        $url = url('index/index/test');
        $this->redirect($url);
    }

}
