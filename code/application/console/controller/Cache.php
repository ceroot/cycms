<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Cache.php[缓存控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @date      2016-04-21 14:02:52
 * @site      http://www.benweng.com
 */

namespace app\console\controller;

use app\console\controller\Base;
// use think\Controller;
use third\Dir;

class Cache extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function cache()
    {
        $action = input('post.');
        cache('action', $action['action']);
        return $this->success('准备更新...', url('cache/update'));

        die;
        if (IS_POST) {
            $action = input('post.action');
            cache('action', $action);
            return $this->success('准备更新...', url('cache/update'));
        } else {
            return $this->fetch();
        }

    }

    public function cachedo()
    {
        $action = input('post.action');
        cache('action', $action);
        return $this->success('准备更新...', url('cache/update'));
    }

    public function update()
    {
        $action = cache('action');

        if ($action) {
            $current = array_shift($action);
            $this->assign('waitSecond', 1);
            cache('action', $action);
            switch ($current) {
                case 'Config':
                    //D('Config')->write_config();
                    return $this->success('网站配置更新成功...', url('cache/update'));
                    break;
                case 'Category':
                    //D('Category')->update_cache();
                    return $this->success('栏目缓存更新成功...', url('cache/update'));
                    break;
                case 'Table':

                    // 自定义模型缓存更新
                    //D('Model')->update_cache();
                    // 自定义模型字段缓存更新
                    //D("ModelField")->update_cache();
                    // 文档类型缓存更新
                    //D('Type')->update_cache();
                    // 文档属性缓存更新
                    //D('Attr')->update_cache();
                    // 广告位置缓存更新
                    //D('Position')->update_cache();
                    // 规则缓存更新
                    model("authRule")->updateCache();
                    // 会员登记缓存更新
                    //D('UserGrade')->update_cache();
                    // 地区更新
                    //D('Region')->update_cache();

                    // 载入目录处理类

                    is_file(RUNTIME_PATH . 'common~runtime.php') &&
                    unlink(RUNTIME_PATH . 'common~runtime.php');
                    // 删除目录
                    Dir::del(RUNTIME_PATH . 'cache');
                    Dir::del(RUNTIME_PATH . 'temp');
                    Dir::del(RUNTIME_PATH . 'data');
                    Dir::del(RUNTIME_PATH . 'logs');
                    // // 创建目录
                    // $dir= array(
                    //     RUNTIME_PATH.'Cache',
                    //     RUNTIME_PATH.'Data',
                    //     RUNTIME_PATH.'Logs',
                    // );
                    // foreach($dir as $v)
                    // {
                    //     is_dir($v) || mkdir($v,0777,true);
                    // }

                    return $this->success('数据表缓存更新成功...', url('cache/update'));
                    break;
            }
        } else {
            return $this->success('缓存更新成功...', url('cache/index'));
        }
    }
}
