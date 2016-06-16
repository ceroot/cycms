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
 * @date      2016-06-16 17:49:21
 * @site      http://www.benweng.com
 */
namespace app\console\model;

use app\common\model\Extend;

class Hooks extends Extend
{
    /**
     * 更新插件里的所有钩子对应的插件
     */
    public function updateHooks($addons_name)
    {
        $addons_class = get_addon_class($addons_name); //获取插件名
        if (!class_exists($addons_class)) {
            $this->error = "未实现{$addons_name}插件的入口文件";
            return false;
        }
        $methods = get_class_methods($addons_class);
        $hooks   = $this->column('name');

        $common = array_intersect($hooks, $methods);

        if (!empty($common)) {
            foreach ($common as $hook) {
                $flag = $this->updateAddons($hook, array($addons_name));
                if (false === $flag) {
                    $this->removeHooks($addons_name);
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 更新单个钩子处的插件
     */
    public function updateAddons($hook_name, $addons_name)
    {
        $map['name'] = $hook_name;
        $o_addons    = $this->where($map)->value('addons');

        if ($o_addons) {
            $o_addons = str2arr($o_addons);
        }

        if ($o_addons) {
            $addons = array_merge($o_addons, $addons_name);
            $addons = array_unique($addons);
        } else {
            $addons = $addons_name;
        }
        $flag = $this->where("name='{$hook_name}'")->setField('addons', arr2str($addons));
        if (false === $flag) {
            $this->where("name='{$hook_name}'")->setField('addons', arr2str($o_addons));
        }

        return $flag;
    }

    /**
     * 去除插件所有钩子里对应的插件数据
     */
    public function removeHooks($addons_name)
    {
        $addons_class = get_addon_class($addons_name);
        if (!class_exists($addons_class)) {
            return false;
        }
        $methods = get_class_methods($addons_class);
        // $hooks   = $this->getField('name', true);
        $hooks  = $this->column('name');
        $common = array_intersect($hooks, $methods);

        if ($common) {
            foreach ($common as $hook) {
                $flag = $this->removeAddons($hook, array($addons_name));
                if (false === $flag) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 去除单个钩子里对应的插件数据
     */
    public function removeAddons($hook_name, $addons_name)
    {
        $o_addons = $this->where("name='{$hook_name}'")->value('addons');

        $o_addons = str2arr($o_addons);

        if ($o_addons) {
            $addons = array_diff($o_addons, $addons_name);
        } else {
            return true;
        }

        $flag = model('hooks')->where("name='{$hook_name}'")
            ->setField('addons', arr2str($addons));
        if (false === $flag) {
            model('Hooks')->where("name='{$hook_name}'")
                ->setField('addons', arr2str($o_addons));
        }

        return $flag;
    }
}
