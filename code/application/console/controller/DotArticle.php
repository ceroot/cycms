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
				$pattern = '<img.*?src="(.*?)">';
				preg_match_all($pattern, $contentForm, $matchesForm);
				$imgForm = $matchesForm[1];

				$contentSql = $data['content'];
				preg_match_all($pattern, $contentSql, $matchesSql);
				$imgSql = $matchesSql[1];

				foreach ($imgForm as $value) {
					if (in_array($value, $imgSql)) {
						$k = array_search($value, $imgSql);
						unset($imgSql[$k]);
					}
				}

				foreach ($imgSql as $value) {
					$arr = parse_url($value);
					$path = $arr['path'];
					if (file_exists('.' . $path)) {
						unlink('.' . $path);
					}
				}
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

	public function file() {
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

	public function ppp() {
		$str = '<p style="text-indent: 2em; text-align: left;">华为的官方解释则是：在ICT产业中，友商之间应该通过开放式的创新、联合创新的方式共同推动产业进步。业界解决知识产权问题的最佳途径，是通过谈判签订专利交叉许可协议后合法使用对方开发的技术和知识产权。诉讼是最后的解决争议的方式，在某些情况下也是一种常见方式。</p><p style="text-indent: 2em; text-align: left;">此，三星方面回应《中国经济周刊》记者称，“我们会对诉讼做彻底评估，并采取适当行动维护三星的业务利益”。截至发稿，记者未获得华为方面的采访回应。
</p><p style="text-indent: 2em; text-align: left;">为何同时在中国、美国两地起诉</p>';
		// $pattern = '/<p[^>]*>(.*?)<\/p>/';
		$pp = preg_match($pattern, $str, $matches);
		dump($pp);
		dump($matches[1]);
	}

}
