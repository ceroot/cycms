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
 * @date      2016-06-06 11:49:58
 * @site      http://www.benweng.com
 */
namespace app\common\model;

use app\common\model\Extend;
use think\Input;

class DotArticle extends Extend {

	public function datahandle() {

		$data = input('post.');

		// 封面保存并取得路径
		$file = Input::file('images');
		if ($file) {
			$info = $file->move('./data/images/');
			if ($info) {
				$filename = $info->getFilename();
				$data['cover'] = date('Ymd') . '/' . $filename;
			}
		}

		// 关键词处理
		if (empty($data['keywords'])) {
			$str = strip_tags($data['content']); // 去掉 html 代码
			$str = str_replace(' ', '', $str); // 去掉空格
			$str = str_replace('&nbsp;', '', $str); // 去掉 &nbsp;
			$data['keywords'] = get_keywords($str);
		}

		// 描述处理
		if (empty($data['description'])) {
			$pattern = '/<p[^>]*>(.*?)<\/p>/';
			$preg = preg_match($pattern, $data['content'], $matches);
			if ($preg) {
				$description = strip_tags($matches[1]);
			} else {
				$description = mb_substr(strip_tags($data['content']), 0, 120);
			}
			$data['description'] = str_replace('&nbsp;', '', str_replace(' ', '', $description));
		}

		if ($data['id']) {
			$status = $this->save($data, ['id' => $data['id']]);
		} else {
			$status = $this->save($data);
		}

		return $status;
	}
}
