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
 * @date      2016-06-17 16:58:08
 * @site      http://www.benweng.com
 */

namespace addons\oauth;

use app\common\controller\Addon;

class OauthAddon extends Addon
{
    public $info = array(
        'name'        => 'Oauth',
        'title'       => '第三方登录插件',
        'description' => '用于第三方登录设置',
        'status'      => 1,
        'author'      => 'SpringYang',
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

    public function oauth($data)
    {
        dump($data);
        dump($this->getConfig());
        $this->assign('addons_data', $data);
        $this->assign('addons_config', $this->getConfig());
        $this->display('content');
    }

}
