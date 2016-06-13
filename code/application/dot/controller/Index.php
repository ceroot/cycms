<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Index.php[首页控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-01 00:06:41
 * @site      http://www.benweng.com
 */
namespace app\dot\controller;

use app\dot\controller\Base;
use third\Data;

class Index extends Base
{
    public function _initialize()
    {
        parent::_initialize();

    }

    public function index()
    {
        $case = model('dotCases')->select();
        $this->assign('case', $case);

        $category = model('dotCategory')->where('hidden')->select();
        $category = Data::channelLevel($category, 0, '', 'id', 'pid');

        // dump($category);
        // die;
        $this->assign('category', $category);
        return $this->fetch();
    }

    public function yctest()
    {
        $case    = model('dotCases')->find(1);
        $content = $case['content'];
        $imgUrl  = $case['show_img'];
        if (empty($imgUrl)) {
            $pattern = '<img.*?src="(.*?)">';
            preg_match_all($pattern, $content, $matches);
            dump($matches[1]);
            if ($matches[1]) {
                $imgUrl = $matches[1];
                $imgUrl = $imgUrl[0];
            } else {
                $imgUrl = '/data/examples/201.jpg';
            }
        }
        dump($imgUrl);
    }
}
