<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Developer.php[开发管理控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-28 11:43:30
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class Developer extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    protected $beforeActionList = [
        'edit_before' => ['only' => 'edit'],
        'del_before'  => ['only' => 'del'],
    ];

    protected function edit_before()
    {
        if (IS_AJAX) {
            $contentForm = input('post.content');
            if (!$contentForm) {
                return false;
            } else {
                $pattern = '<img.*?src="(.*?)">';
                preg_match_all($pattern, $contentForm, $matchesForm);
                $imgForm = $matchesForm[1];

                $pk         = $this->model->getPk();
                $id         = input('post.' . $pk);
                $contentSql = $this->model->getFieldById($id, 'content');
                preg_match_all($pattern, $contentSql, $matchesSql);
                $imgSql = $matchesSql[1];

                foreach ($imgForm as $value) {
                    if (in_array($value, $imgSql)) {
                        $k = array_search($value, $imgSql);
                        unset($imgSql[$k]);
                    }
                }

                foreach ($imgSql as $value) {
                    $arr  = parse_url($value);
                    $path = $arr['path'];
                    if (file_exists('.' . $path)) {
                        unlink('.' . $path);
                    }
                }
            }

        }
    }

    protected function del_before()
    {
        $pk      = $this->model->getPk();
        $id      = input('get.' . $pk);
        $content = $this->model->getFieldById($id, 'content');
        $pattern = '<img.*?src="(.*?)">';
        preg_match_all($pattern, $content, $matches);
        foreach ($matches[1] as $value) {
            if (file_exists('.' . $value)) {
                unlink('.' . $value);
            }
        }

    }

    public function dddd()
    {
        $url = 'http://127.0.0.1:89/data/images/dd.jpg';
        $ddd = parse_url($url);
        dump($ddd);
        die;

        $a1 = ['a', 'b', 'c', 'd'];
        $a2 = ['b', 'e', 'f', 'g'];
        dump($a2);
        dump($a1);
        foreach ($a2 as $value) {
            if (in_array($value, $a1)) {
                $k = array_search($value, $a1);
                dump($a1[$k]);
                unset($a1[$k]);
            }

        }
        dump($a1);
        die;
        $k = array_search('b', $a1);
        unset($a1[$k]);
        dump($a1);

        die;
        $data = [
            '/ueditor/php/upload/image/20160528/1464423663.jpg',
            '/ueditor/php/upload/image/20160528/1464423664.jpg',
            '/ueditor/php/upload/image/20160528/1464423666.jpg',
        ];

        $data2 = [
            '/ueditor/php/upload/image/20160528/1464423664.jpg',
            '/ueditor/php/upload/image/20160528/1464423667.jpg',
            '/ueditor/php/upload/image/20160528/1464423668.jpg',
            '/ueditor/php/upload/image/20160528/1464423669.jpg',
            '/ueditor/php/upload/image/20160528/1464423670.jpg',
            '/ueditor/php/upload/image/20160528/1464423671.jpg',
        ];

        foreach ($data2 as $value) {
            if (in_array($value, $data)) {
                // array_shift($);
            }
        }
        dump($data);
        die;
        $content = $this->model->getFieldById(2, 'content');
        $pattern = '<img.*?src="(.*?)">';
        preg_match_all($pattern, $content, $matches);
        // dump($matches);
        // dump($matches[1]);
        foreach ($matches[1] as $value) {
            dump($value);
        }

    }

    public function view()
    {
        $id  = input('get.id');
        $one = $this->model->find($id);
        $this->assign('one', $one);
        return $this->fetch();
    }

}
