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

	// 写入处理
	public function datahandle() {
		$data = input('post.');
		// return $data['content'];
		$id = input('post.id'); // 因需要到 id 来判断写入形式，所以这里单独获取 id，有 id 的时候是修改，没有 id 的时候是新增

		// 一些路径
		$pathFiles = './data/files/'; // 文件保存路径
		$pathImages = './data/images/'; // 图片保存路径
		$pathVideos = './data/videos/'; // 视频保存路径

		// 封面保存并取得路径
		$file = Input::file('cover');
		if ($file) {
			// 修改时先删除原有图片处理
			if ($id) {
				$coveSql = $this->getFieldById($id, 'cover');

				$pathSql = $pathImages . $coveSql;
				if (is_file($pathSql)) {
					unlink($pathSql);
				}
			}

			// 图片保存
			$info = $file->move($pathImages);
			if ($info) {
				$filename = $info->getFilename();
				$data['cover'] = date('Ymd') . '/' . $filename;
			}
		} else {
			unset($data['cover']); // 如果没有数据则删除数组值
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
			// 当能够正常匹配的时候就使用匹配的值，当不能匹配的时候取前 120
			if ($preg) {
				$description = mb_substr(strip_tags($matches[1]), 0, 120);
				if (empty($description)) {
					$description = mb_substr(strip_tags($data['content']), 0, 120);
				}
			} else {
				$description = mb_substr(strip_tags($data['content']), 0, 120);
			}
			$data['description'] = str_replace('&nbsp;', '', str_replace(' ', '', $description));
		}

		// 对 ueditor 内容数据的处理
		$data['content'] = ueditor_handle($data['content'], $data['title']);

		// 写入形式
		if ($id) {
			$status = $this->save($data, ['id' => $id]);
		} else {
			$status = $this->save($data);
		}

		// 返回状态
		return $status;
	}
}
