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
 * @date      2016-06-17 17:52:20
 * @site      http://www.benweng.com
 */
namespace app\api\controller;

use app\common\controller\Extend;

class Oauth extends Extend
{

    public function index()
    {

    }

    public function execute($_addons = null, $_controller = null, $_action = null)
    {
        if (config('URL_CASE_INSENSITIVE')) {
            $_addons     = ucfirst(parse_name($_addons, 1));
            $_controller = parse_name($_controller, 1);
        }

        $TMPL_PARSE_STRING                  = config('view_replace_str');
        $TMPL_PARSE_STRING['__ADDONROOT__'] = CODE_PATH . "/addons/{$_addons}";
        config('view_replace_str', $TMPL_PARSE_STRING);

        if (!empty($_addons) && !empty($_controller) && !empty($_action)) {
            // $Addons = controller("addons://{$_addons}/{$_controller}")->$_action();
            $class  = "\\addons\\{$_addons}\\controller\\{$_controller}";
            $Addons = new $class;
            $Addons->$_action();
            // dump($ddd);
        } else {
            $this->error('没有指定插件名称，控制器或操作！');
        }
    }
}
