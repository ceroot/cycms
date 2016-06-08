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

		// 图片替换处理
		// $patternImg = '<img.*?src="(.*?)">';
		$patternImg = '/<img.*?src="(.*?)".*?>/is';
		if (preg_match_all($patternImg, $data['content'], $matchesImg)) {
			// return $matchesImg;
			$replaceData = [];
			foreach ($matchesImg[0] as $key => $value) {
				if (stripos($value, 'data/ueditor') !== false) {
					$oldValue = $newValue = $value; // 临时变量
					$imageSrc = $matchesImg[1][$key]; // 取得 img 里的 src
					$imagesArr = explode('/', $imageSrc); // 以 / 拆分 src 变为数组
					$imagesName = end($imagesArr); // 取得数组里的最后一个值，也就是文件名
					$datePath = array_slice($imagesArr, -2, 1); // 取得数组里的倒数第二个值，也就是以日期命名的目录
					$newPath = $pathImages . $datePath[0] . '/'; // 新的文件目录

					// 判断目录是否存在，如果不存在则创建
					if (!is_dir($newPath)) {
						make_dir($newPath);
					}

					// 文件移动
					$newPath = $newPath . $imagesName; // 新路径
					$imageSrc = '.' . $imageSrc; // 旧路径
					if (is_file($imageSrc)) {
						rename($imageSrc, $newPath);
					}

					// alt 替换
					$patternAlt = '/<img.*alt\=[\"|\'](.*)[\"|\'].*>/i'; // alt 规则
					$newAlt = 'alt="' . $data['title'] . '"'; // 新的 alt

					$altPreg = preg_match($patternAlt, $oldValue, $matchAlt);
					if ($altPreg) {
						$newValue = preg_replace('/alt=.+?[*|\"]/i', $newAlt, $newValue);
					} else {
						$valueTemp = str_replace('/>', '', $newValue);
						$newValue = $valueTemp . ' ' . $newAlt . '/>';
					}

					// 标题替换处理
					$patternTitle = '/<img.*title\=[\"|\'](.*)[\"|\'].*>/i'; // title 规则
					$newTitle = 'title="' . $data['title'] . '"'; // 新的 title

					$titlePreg = preg_match($patternTitle, $oldValue, $matchTitle);
					if ($titlePreg) {
						$newValue = preg_replace('/title=.+?[*|\"]/i', $newTitle, $newValue);
					} else {
						$valueTemp = str_replace('/>', '', $newValue);
						$newValue = $valueTemp . ' ' . $newTitle . '/>';
					}

					// 样式为空替换处理
					$stylePattern = '<img.*?style="(.*?)">'; // style 规则
					$stylePreg = preg_match($stylePattern, $oldValue, $styleMatch);
					if ($stylePreg) {
						if (empty($styleMatch[1])) {
							$newValue = preg_replace('/style=.+?[*|\"]/i', '', $newValue);
						}
					}

					// 替换成新的图片路径
					$newValue = str_replace('ueditor/', '', $newValue);

					$replaceData[] = [$oldValue => $newValue];

				}
			}

			return $replaceData;

			die;
			// 内容替换成新的图片路径
			foreach ($imagesTemp as $value) {
				$newValue = str_replace('ueditor/', '', $value);
				$data['content'] = str_replace($value, $newValue, $data['content']);
			}
		}

		/*
			        $patternHrf = '/<a.*?href=[\'\"]?([^\'\" ]+).*?>/';

			        $pattern = '/<p[^>]*>(.*?)<\/p>/';
		*/

		// 文件替换处理
		if (preg_match_all("'<\s*a\s.*?href\s*=\s*([\"\'])?(?(1)(.*?)\\1|([^\s\>]+))[^>]*>?(.*?)</a>'isx", $data['content'], $links)) {
			while (list($key, $val) = each($links[2])) {
				if (!empty($val)) {
					$match['link'][] = $val;
				}
			}
			while (list($key, $val) = each($links[3])) {
				if (!empty($val)) {
					$match['link'][] = $val;
				}
			}
			while (list($key, $val) = each($links[4])) {
				if (!empty($val)) {
					$match['content'][] = $val;
				}
			}
			while (list($key, $val) = each($links[0])) {
				if (!empty($val)) {
					$match['all'][] = $val;
				}

			}

			$linkTemp = [];
			foreach ($match['link'] as $value) {
				if (stripos($value, 'data/ueditor') !== false) {
					$linkTemp[] = $value;
					$linkArr = explode('/', $value);
					$datePath = array_slice($linkArr, -2, 1);
					$fileName = end($linkArr);
					$newPath = $pathFiles . $datePath[0] . '/';

					// 判断目录是否存在，如果不存在则创建
					if (!is_dir($newPath)) {
						make_dir($newPath);
					}

					$newPath = $newPath . $fileName; // 新路径
					$value = '.' . $value; // 旧路径
					if (is_file($value)) {
						rename($value, $newPath);
					}
				}
			}

			// 内容替换成新的文件路径
			foreach ($linkTemp as $value) {
				$newvalue = str_replace('ueditor/', '', $value);
				$data['content'] = str_replace($value, $newvalue, $data['content']);
			}
		}

		// 附件小图标处理
		if (stripos($data['content'], 'ueditor/1.4.3.2/dialogs/attachment') !== false) {
			$data['content'] = str_replace('ueditor/1.4.3.2/dialogs/attachment', 'images', $data['content']);
		}

		// 写入形式
		if ($id) {
			$status = $this->save($data, ['id' => $id]);
		} else {
			$status = $this->save($data);
		}

		return $status;
	}
}
