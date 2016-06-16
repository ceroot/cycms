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
    'think_sdk_qq'    => [
        'app_key'    => '100251165',
        'app_secret' => '114d7761ae3f641f82aded9acce3c5a4',
        'callback'   => 'http://www.benweng.com/oauthcallback?type=qq',
    ],

    'think_sdk_sina'  => [
        'app_key'    => '4198022214',
        'app_secret' => 'bfaf29ca1f9586af79060947856b42e9',
        'callback'   => 'http://www.benweng.com/oauthcallback?type=sina',
    ],

    'think_sdk_baidu' => [
        'app_key'    => '00VgPgxfGjNPwi2WzBAsVOAy',
        'app_secret' => 'VjQ3Dw2l6DGpfoveQQyCms3iIErYqHYz',
        'callback'   => 'http://www.benweng.com/oauthcallback?type=sina',
    ],

];
