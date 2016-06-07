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

class DotArticle extends Extend
{

    // 写入处理
    public function datahandle()
    {
        $data = input('post.');
        $id   = input('post.id'); // 因需要到 id 来判断写入形式，所以这里单独获取 id，有 id 的时候是修改，没有 id 的时候是新增

        // 封面保存并取得路径
        $file = Input::file('cover');
        if ($file) {
            // 修改时删除原有处理
            if ($id) {
                $coveSql = $this->getFieldById($id, 'cover');
                $path    = '/data/images/' . $coveSql;
                if (is_file('.' . $path)) {
                    unlink('.' . $path);
                }
            }

            // 图片保存
            $info = $file->move('./data/images/');
            if ($info) {
                $filename      = $info->getFilename();
                $data['cover'] = date('Ymd') . '/' . $filename;
            }
        } else {
            unset($data['cover']); // 如果没有数据则删除数组值
        }

        // 关键词处理
        if (empty($data['keywords'])) {
            $str              = strip_tags($data['content']); // 去掉 html 代码
            $str              = str_replace(' ', '', $str); // 去掉空格
            $str              = str_replace('&nbsp;', '', $str); // 去掉 &nbsp;
            $data['keywords'] = get_keywords($str);
        }

        // 描述处理
        if (empty($data['description'])) {
            $pattern = '/<p[^>]*>(.*?)<\/p>/';
            $preg    = preg_match($pattern, $data['content'], $matches);
            // 当能够正常匹配的时候就使用匹配的值，当不能匹配的时候取前 120
            if ($preg) {
                $description = mb_substr(strip_tags($matches[1]), 0, 120);
            } else {
                $description = mb_substr(strip_tags($data['content']), 0, 120);
            }
            $data['description'] = str_replace('&nbsp;', '', str_replace(' ', '', $description));
        }

        // 图片替换处理
        $patternImg = '<img.*?src="(.*?)">';
        if (preg_match_all($patternImg, $data['content'], $matchesImg)) {
            foreach ($matchesImg[1] as $value) {
                if (stripos($value, 'ueditor') !== false) {
                    $nameArr  = explode('/', $value);
                    $datePath = array_slice($nameArr, -2, 1);
                    $name     = end($nameArr);
                    $newPath  = './data/images/' . $datePath[0] . '/';

                    // 判断目录是否存在，如果不存在则创建
                    if (!is_dir($newPath)) {
                        make_dir($newPath);
                    }

                    $newPath = $newPath . $name; // 新路径
                    $value   = '.' . $value; // 旧路径
                    if (is_file($value)) {
                        rename($value, $newPath);
                    }
                }
            }

            // 内容全局替换成新的路径
            $data['content'] = str_replace('ueditor/', '', $data['content']);
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
