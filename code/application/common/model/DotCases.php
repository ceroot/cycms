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
 * @date      2016-06-03 11:32:33
 * @site      http://www.benweng.com
 */
namespace app\common\model;

use app\common\model\Extend;

class DotCases extends Extend
{
    public function getImgUrlAttr($value, $data)
    {
        $imgUrl = $data['show_img'];
        if (empty($imgUrl)) {
            $pattern = '<img.*?src="(.*?)">';
            preg_match_all($pattern, $data['content'], $matches);
            if ($matches[1]) {
                $imgUrl = $matches[1];
                $imgUrl = $imgUrl[0];
            } else {
                $imgUrl = '/data/examples/201.jpg';
            }
        }
        return $imgUrl;
    }

}
