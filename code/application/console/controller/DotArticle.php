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

class DotArticle extends Base {
	/**
	 * [_initialize 初始化]
	 * @return [type] [description]
	 */
	public function _initialize() {
		parent::_initialize();
		$category = model('dotCategory')->getAll();
		$this->assign('category', $category);
		// dump($category);
	}

	protected $beforeActionList = [
		'add_before' => ['only' => 'add'],
		'edit_before' => ['only' => 'edit'],
	];

	protected function add_before() {
		$cid = input('cid');
		if ($cid == '-1') {
			return $this->error('请选择分类');
		}
	}

	protected function edit_before() {
		if (request()->isAjax()) {
			$cid = input('cid');
			if ($cid == '-1') {
				return $this->error('请选择分类');
			}
			$id = input('post.id');
			$data = db(CONTROLLER_NAME)->find($id);
			$file = Input::file('images');
			if ($file) {
				$path = '/data/images/' . $data['cover'];
				if (file_exists('.' . $path)) {
					unlink('.' . $path);
				}
			}

			$contentForm = input('post.content');
			if (!$contentForm) {
				return false;
			} else {

				$contentSql = $data['content'];
				// 对比判断并删除操作
				del_images($contentForm, $contentSql);
			}
		}
	}

	public function add() {
		if (request()->isAjax()) {
			$data = input('post.');

			$status = $this->model->validate(true);
			if ($status === false) {
				return $this->error($this->model->getError());
			}

			$status = $this->model->datahandle();
			// return $status;
			if ($status) {
				action_log($status); // 记录日志
				return $this->success('添加成功', url('list'));
			} else {
				// return $this->error('失败');
				return $this->model->getError();
			}
		} else {

			return $this->fetch();
		}
	}

	public function edit() {
		if (request()->isAjax()) {
			$data = input('post.');

			$status = $this->model->validate(true);
			if ($status === false) {
				return $this->error($this->model->getError());
			}

			$status = $this->model->datahandle();
			// return $status;
			if ($status) {
				action_log($data['id']); // 记录日志
				return $this->success('修改成功', url('list'));
			} else {
				// return $this->error('失败');
				return $this->model->getError();
			}
		} else {
			$id = input('get.id');
			if (!$id) {
				return $this->error('参数错误');
			}

			$one = db(CONTROLLER_NAME)->find($id);
			$this->assign('one', $one);
			return $this->fetch();
		}
	}

}
