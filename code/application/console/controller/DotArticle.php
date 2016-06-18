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
    }

    protected $beforeActionList = [
        'add_before'  => ['only' => 'add'],
        'edit_before' => ['only' => 'edit'],
    ];

    protected function add_before()
    {

    }

    protected function edit_before()
    {

    }

    public function add()
    {
        if (request()->isAjax()) {
            $data   = input('post.');
            $result = $this->validate($data, request()->controller());

            if ($result !== true) {
                return $this->error($result);
            }

            $status = $this->model->datahandle();
            // return $status;
            if ($status) {
                action_log($status); // 记录日志
                return $this->success('添加成功', url('list'));
            } else {
                return $this->model->getError();
            }
        } else {
            return $this->fetch();
        }
    }

    public function edit()
    {
        $method = strtolower(request()->method());

        switch ($method) {
            case 'get':
                $id = input('get.id');
                break;
            case 'post':
                $id = input('post.id');
                break;
            default:
                return $this->error('提交有误，请重试');
                break;
        }

        if (!$id) {
            return $this->error('参数错误');
        }

        // 读取数据
        $one = db(request()->controller())->find($id);

        // 判断提交类型
        if (request()->isAjax()) {
            $data   = input('post.');
            $result = $this->validate($data, request()->controller());

            if ($result !== true) {
                return $this->error($result);
            }

            // 修改时对封面的处理
            $file = request()->file('cover');
            if ($file) {
                if (!empty($one['cover'])) {
                    $path = '/data/images/' . $one['cover'];
                    if (file_exists('.' . $path)) {
                        unlink('.' . $path);
                    }
                }
            }

            $contentForm = $data['content'];
            if ($contentForm) {

                $contentSql = $one['content'];
                if (!empty($contentSql)) {
                    // 对比判断并删除操作
                    $del_file = del_file($contentForm, $contentSql);
                }
            }

            $status = $this->model->datahandle();
            // return $status;
            if ($status) {
                action_log($data['id']); // 记录日志
                return $this->success('修改成功', url('list'));
            } else {
                return $this->model->getError();
            }
        } else {
            $this->assign('one', $one);
            return $this->fetch();
        }
    }

    public function images()
    {
        $newimage = new \imageresize\ImageResize();
        $dd       = $newimage->resize("./data/images/20160612/d25d8002beafe722f45ab46c5343bac6.jpg", "./data/images/20160612/test_400_400.jpg", 800, 500);
        dump($dd);

    }

}
