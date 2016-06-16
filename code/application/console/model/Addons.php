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
 * @date      2016-06-16 14:51:27
 * @site      http://www.benweng.com
 */

namespace app\console\model;

use app\common\model\Extend;

class Addons extends Extend
{

    /**
     * 获取插件的后台列表
     */
    public function getAdminList()
    {

        $db_addons = $this->where("status=1 AND has_adminlist=1")->field('title,name')->select();
        $admin     = array();
        if ($db_addons) {
            foreach ($db_addons as $value) {
                $admin[] = array('title' => $value['title'], 'url' => "Addons/adminList?name={$value['name']}");
            }
        }
        return $admin;
    }

    /**
     * 获取插件列表
     * @param string $addon_dir
     */
    public function getList($addon_dir = '')
    {
        if (!$addon_dir) {
            $addon_dir = CODE_PATH . 'addons/';
        }

        $dirs = array_map('basename', glob($addon_dir . '*', GLOB_ONLYDIR));
        if ($dirs === false || !file_exists($addon_dir)) {
            $this->error = '插件目录不可读或者不存在';
            return false;
        }
        $addons        = array();
        $where['name'] = array('in', $dirs);
        $list          = $this->where($where)->select();

        foreach ($list as $addon) {
            $addon['uninstall']     = 0;
            $addons[$addon['name']] = $addon;
        }
        foreach ($dirs as $value) {
            if (!isset($addons[$value])) {
                $class = get_addon_class($value);
                if (!class_exists($class)) {
                    // 实例化插件失败忽略执行
                    \Think\Log::record('插件' . $value . '的入口文件不存在！');
                    continue;
                }
                $obj            = new $class;
                $addons[$value] = $obj->info;
                if ($addons[$value]) {
                    $addons[$value]['uninstall'] = 1;
                    unset($addons[$value]['status']);
                }
            }
        }
        int_to_string($addons, array('status' => array(-1 => '损坏', 0 => '禁用', 1 => '启用', null => '未安装')));
        // dump($addons);die;
        $addons = list_sort_by($addons, 'uninstall', 'desc');

        return $addons;
    }
}
