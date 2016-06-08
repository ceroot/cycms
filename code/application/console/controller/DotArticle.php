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
		if (request()->isAjax()) {
			$cid = input('cid');
			if ($cid == '-1') {
				return $this->error('请选择分类');
			}
		}
	}

	protected function edit_before() {

	}

	public function add() {
		if (request()->isAjax()) {
			$data = input('post.');
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
				// return $this->error('失败');
				return $this->model->getError();
			}
		} else {

			return $this->fetch();
		}
	}

	public function edit() {
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

		$one = db(request()->controller())->find($id);

		if (request()->isAjax()) {
			// $file = Input::file('cover');

			$data = input('post.');
			$result = $this->validate($data, request()->controller());

			if ($result !== true) {
				return $this->error($result);
			}

			$file = Input::file('images');
			if ($file) {
				$path = '/data/images/' . $one['cover'];
				if (file_exists('.' . $path)) {
					unlink('.' . $path);
				}
			}

			$contentForm = $data['content'];
			if ($contentForm) {
				$contentSql = $one['content'];
				// 对比判断并删除操作
				del_images($contentForm, $contentSql);
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
			$this->assign('one', $one);
			return $this->fetch();
		}
	}

	public function file() {
		$path = '/data/image/';
		$name = '200.jpg';
		return $path . $name;
	}

}
