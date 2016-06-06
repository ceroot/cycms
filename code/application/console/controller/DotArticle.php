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
 * @date      2016-06-06 11:48:26
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;
use think\Input;

class DotArticle extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
        $category = model('dotCategory')->getAll();
        $this->assign('category', $category);
        // dump($category);
    }

    protected $beforeActionList = [
        'add_before'  => ['only' => 'add'],
        'edit_before' => ['only' => 'edit'],
    ];

    protected function add_before()
    {
        $cid = input('cid');
        if ($cid == '-1') {
            return $this->error('请选择分类');
        }
    }

    protected function edit_before()
    {
        $cid = input('cid');
        if ($cid == '-1') {
            return $this->error('请选择分类');
        }
    }

    public function add()
    {
        if (request()->isAjax()) {
            $data   = input('post.');
            $status = $this->model->validate(true);

            if ($status === false) {
                return $this->error($this->model->getError());
            }

            $file = Input::file('images');
            $info = $file->move('./data/image/');
            // return $info;
            if ($info) {
                $filename = $info->getFilename();

                $data['cover'] = $info->getFilename();
            }
            // return $info->getPathname();
            $status = $this->model->save($data);
            // return $data;
            if ($status) {

                action_log($status, 'dotarticle_add'); // 记录日志
                return $this->success('添加成功', url('list'));
            } else {
                // return $this->error('失败');
                return $this->model->getError();
            }
        } else {

            return $this->fetch();
        }
    }

    public function file()
    {
        if (request()->isAjax()) {
            $file = Input::file('images');
            $info = $file->move('./data/test/');
            if ($info) {
                // 成功上传后 获取上传信息
                // return $info->getExtension(); // 输出 jpg
                return $info->getPathname(); // 输出 42a79759f284b767dfcb2a0197904287.jpg
            } else {
                // 上传失败获取错误信息
                return $file->getError();
            }
            return $file;
        } else {
            return $this->fetch();
        }
    }

}
