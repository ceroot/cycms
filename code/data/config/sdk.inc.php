<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  sdk.inc.php [sdk 配置]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-15 11:21:15
 * @site      http://www.benweng.com
 */

return [
    'think_sdk_qq'   => [
        'app_key'    => '100251165',
        'app_secret' => '114d7761ae3f641f82aded9acce3c5a4',
        'callback'   => 'http://www.benweng.com/index/oauth/callback?type=qq',
    ],

    'think_sdk_sina' => [
        'app_key'    => '100251165',
        'app_secret' => '114d7761ae3f641f82aded9acce3c5a4',
        'callback'   => 'http://127.0.0.1/yfcmf/index.php?m=Home&c=oauth&a=callback&type=qq',
    ],

];
