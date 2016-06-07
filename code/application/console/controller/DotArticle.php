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
            $data = input('post.');
            // return $data;
            $status = $this->model->validate(true);

            if ($status === false) {
                return $this->error($this->model->getError());
            }

            // 封面保存并取得路径
            $file = Input::file('images');
            $info = $file->move('./data/images/');

            if ($info) {
                $filename = $info->getFilename();

                $data['cover'] = date('Ymd') . '/' . $filename;
            }

            // 关键词处理
            if (empty($data['keywords'])) {
                $data['keywords'] = get_keywords($data['content']);
            }

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

    public function scws()
    {
        Vendor('scws.pscws4');
        $pscws = new \PSCWS4();
        $pscws->set_dict(VENDOR_PATH . 'scws/lib/dict.utf8.xdb');
        $pscws->set_rule(VENDOR_PATH . 'scws/lib/rules.utf8.ini');
        $title = '第三方中文分词';
        $pscws->set_ignore(true);
        $pscws->send_text($title);
        $words = $pscws->get_tops(5);
        dump($words);
        $tags = array();
        foreach ($words as $val) {
            $tags[] = $val['word'];
        }
        $pscws->close();
        dump($tags);
        //结果
        //         array (size=3)
        //         0 => string '分词' (length=6)
        //         1 => string '中文' (length=6)
        //         2 => string '第三方' (length=9)
    }

}
