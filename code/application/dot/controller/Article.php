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
 * @date      2016-06-13 16:40:30
 * @site      http://www.benweng.com
 */
namespace app\dot\controller;

use app\dot\controller\Base;

class Article extends Base
{

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    function list() {
        $cid = input('get.cid');
        if (!$cid) {
            return $this->error('参数错误');
        }
        $list = db('dotArticle')->where('cid', $cid)->select();
        // dump($list);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function view()
    {
        $id = input('get.id');
        if (!$id && is_numeric($id)) {
            return $this->error('参数错误', url('dot/index/index'));
        }

        $one = db('dotArticle')->find($id);

        if (empty($one)) {
            return $this->error('数据不存在', url('dot/index/index'));
        }

        $this->assign('one', $one);
        $category = model('dotCategory')->getAll(1);
        $this->assign('category', $category);
        $case = model('dotCases')->select();
        $this->assign('case', $case);
        return $this->fetch();
    }
}
