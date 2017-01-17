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
 * @date      2016-06-17 20:59:28
 * @site      http://www.benweng.com
 */

namespace addons\oauth\model;

use think\Model;

class OauthUser extends Model
{

    public function test()
    {
        return 'test';
    }

    function list() {
        $data = $this->select();
        return $data;
    }

}
