<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------

namespace addons\systemInfo;

use app\common\controller\Addon;

/**
 * 系统环境信息插件
 * @author thinkphp
 */

class SystemInfoAddon extends Addon
{

    public $info = array(
        'name'        => 'SystemInfo',
        'title'       => '系统环境信息',
        'description' => '用于显示一些服务器的信息',
        'status'      => 1,
        'author'      => 'thinkphp',
        'version'     => '0.1',
    );

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    //实现的AdminIndex钩子方法
    public function AdminIndex($param)
    {
        $config = $this->getConfig();

        if (extension_loaded('curl')) {
            // $url    = 'http://www.onethink.cn/index.php?m=home&c=check_version';
            $url    = '';
            $params = array(
                'version' => config('cms_version'),
                'domain'  => $_SERVER['HTTP_HOST'],
                'auth'    => sha1(config('data_auth_key')),
            );

            $vars = http_build_query($params);
            $opts = array(
                CURLOPT_TIMEOUT        => 5,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL            => $url,
                CURLOPT_POST           => 1,
                CURLOPT_POSTFIELDS     => $vars,
                CURLOPT_USERAGENT      => $_SERVER['HTTP_USER_AGENT'],
            );

            /* 初始化并执行curl请求 */
            $ch = curl_init();
            curl_setopt_array($ch, $opts);
            $data  = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);
        }

        if (!empty($data) && strlen($data) < 400) {
            // $config['new_version'] = $data;
            $config['new_version'] = 1;
        }

        $this->assign('addons_config', $config);
        if ($config['display']) {
            $this->display('widget');
        }
    }
}
