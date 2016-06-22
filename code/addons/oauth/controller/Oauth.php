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

use addons\oauth\ThinkSDK\ThinkOauth;
use think\Controller;

class Oauth extends Controller
{
    public function _initialize()
    {
        $oauth_sdk_config = cache('oauth_sdk_config'); // 读取缓存配置
        if (!$oauth_sdk_config) {
            $db_sdk_config_data = db('addons')->where('name', 'Oauth')->find();
            if (!$db_sdk_config_data) {
                $this->error('没有开通第三方登录');
            }
            if ($db_sdk_config_data['status'] == 0) {
                $this->error('第三方登录关闭');
            }

            // 数据处理
            $db_sdk_config = $db_sdk_config_data['config'];
            $db_sdk_config = str_replace('{', '', $db_sdk_config);
            $db_sdk_config = str_replace('}', '', $db_sdk_config);
            $db_sdk_config = str_replace('"', '', $db_sdk_config);
            $db_sdk_config = explode(',', $db_sdk_config);

            $oauth_sdk_config = [];
            foreach ($db_sdk_config as $value) {
                $temp                       = explode(':', $value);
                $oauth_sdk_config[$temp[0]] = $temp[1];
            }
        }
        // 加入配置
        config($oauth_sdk_config);
    }

    public function index()
    {
        $class = "\\addons\\oauth\\model\\OauthUser";
        $model = new $class;
        $test  = $model->list();
        dump($test);
        dump('这是第三方登录插件控制器');
    }

    public function login()
    {
        $type = input('type');
        if (empty($type)) {
            return $this->error('参数错误');
        }
        $oauth_status = 'think_sdk_' . strtolower($type) . '_on';
        // 判断是否开启
        if (!config($oauth_status)) {
            return $this->error('没有开启');
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

            // $user_info = controller('type', 'event')->$type($token);
            // dump($user_info);
            // dump($token);
            $class     = "\\addons\\oauth\\event\\Type";
            $obj       = new $class;
            $user_info = $obj->$type($token);

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

        $class = "\\addons\\oauth\\model\\OauthUser";
        $model = new $class;

        // $oauth_user_sql = db('oauthUser')->where($map)->find();
        $oauth_user_sql = $model->where($map)->find();
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
            $status = $model->save($data, ['id' => $id]);
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

            $status = $model->save($data);
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

    public function menu()
    {
        echo $this->fetch('../code/addons/oauth/view/menu.html');
        die;
        $ation = input('get._action');
        $view  = new \think\View();
        echo $view->fetch('../code/addons/oauth/view/menu.html');
        // $dd = view('../code/addons/oauth/view/menu.html');
        // echo $dd;
        // return $this->fetch('../code/addons/oauth/view/menu.html');
        // return $this->fetch(CODE_PATH . 'addons/oauth/view/menu.html');
    }

    public function config()
    {
        if (request()->isAjax()) {
            $data = db('manager')->find(1);
            $data = json_encode($data);
            echo $data;
        } else {
            $this->error('数据有误');
            die;
            echo $this->fetch('../code/addons/oauth/view/config.html');
        }
    }

    public function test()
    {
        $array = [9, 8, 5, 3, 1];
        $index = [4, 3, 0, 1, 2, 2, 2, 1, 4, 4, 3];
        $tel   = '';
        foreach ($sort as $value) {
            $tel .= $code[$value];
        }
        echo $tel;
    }

    public function tel()
    {
        $code = [9, 8, 5, 3, 1];
        $sort = [4, 3, 0, 1, 2, 2, 2, 1, 4, 4, 3];
        $tel  = '';
        foreach ($sort as $value) {
            $tel .= $code[$value];
        }
        $name = base64_decode('5p2o5pil');
        echo '标识：' . $name . '<br>';
        echo '电话：' . $tel;
    }

}
