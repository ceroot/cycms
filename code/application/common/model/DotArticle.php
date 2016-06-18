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

class DotArticle extends Extend
{
    public function getCategoryTextAttr($value, $data)
    {
        $cid   = $data['cid'];
        $title = db('dotCategory')->getFieldById($cid, 'title');
        return $title;
    }

    // 写入处理
    public function datahandle()
    {
        $data = input('post.');
        // return $data['content'];
        $id = input('post.id'); // 因需要到 id 来判断写入形式，所以这里单独获取 id，有 id 的时候是修改，没有 id 的时候是新增

        // 一些路径
        $pathFiles  = './data/files/'; // 文件保存路径
        $pathImages = './data/images/'; // 图片保存路径
        $pathVideos = './data/videos/'; // 视频保存路径
        $pathTemp   = './data/temp/'; // 临时文件存放路径

        // 封面保存并取得路径
        $file = request()->file('cover');
        if ($file) {
            // 修改时先删除原有图片处理
            if ($id) {
                $coveSql = $this->getFieldById($id, 'cover');

                $pathSql = $pathImages . $coveSql;
                if (is_file($pathSql)) {
                    unlink($pathSql);
                }
            }

            // 封面图片保存
            $info = $file->move($pathTemp);
            if ($info) {
                $filename = $info->getFilename();
                $ymd      = date('Ymd') . '/';
                $tempFile = $pathTemp . $ymd . $filename;
                $savePath = $pathImages . $ymd . $filename;
                if (!file_exists($pathImages . $ymd)) {
                    make_dir($pathImages . $ymd);
                }

                if (is_file($tempFile)) {
                    // 取得文件信息
                    $imageInfo = getimagesize($tempFile);
                    if ($imageInfo) {
                        // 判断图片宽度来是否进行缩小操作
                        if ($imageInfo[0] > 800) {
                            // 实例化图片尺寸类
                            $newimage = new \imageresize\ImageResize();
                            $result   = $newimage->resize($tempFile, $savePath, 800, 500);
                            if ($result) {
                                $cover = $ymd . $filename;
                                unlink($tempFile); // 删除临时文件
                            }
                        } else {
                            // 移动文件
                            $result = rename($tempFile, $savePath);
                            if ($result) {
                                $cover = $ymd . $filename;
                            }
                        }
                    }
                }

                // 如果取得则给数组加cover值
                if ($cover) {
                    $data['cover'] = $ymd . $filename;
                } else {
                    unset($data['cover']); // 如果没有数据则删除数组值
                }
            }
        } else {
            unset($data['cover']); // 如果没有数据则删除数组值
        }

        // 关键词处理
        if (empty($data['keywords'])) {
            $data['keywords'] = get_keywords($data['content']);
        }

        // 描述处理
        if (empty($data['description'])) {
            $data['description'] = get_description($data['content']);
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
