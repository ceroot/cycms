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
 * @date      2016-06-16 14:50:24
 * @site      http://www.benweng.com
 */

namespace app\console\controller;

use app\console\controller\Base;

class Addons extends Base
{

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        $this->assign('_extra_menu', array(
            '已装插件后台' => model('Addons')->getAdminList(),
        ));
        parent::_initialize();
    }

    /**
     * 插件列表
     */
    public function index()
    {
        $this->meta_title = '插件列表';
        $list             = model('addons')->getList();
        // dump($list);
        // dump($list);die;
        // $request = (array) input('request.');
        // $total   = $list ? count($list) : 1;

        // $listRows = 10;
        // $page     = new \Think\Page($total, $listRows, $request);

        // $voList = array_slice($list, $page->firstRow, $page->listRows);
        // $p      = $page->show();
        $this->assign('_list', $list);
        // $this->assign('_page', $p ? $p : '');
        // 记录当前列表页的cookie
        Cookie('__forward__', $_SERVER['REQUEST_URI']);
        // $this->display();
        return $this->fetch();
    }

    /**
     * 启用插件
     */
    public function enable()
    {
        $id             = input('id');
        $msg            = array('success' => '启用成功', 'error' => '启用失败');
        $data['status'] = 1;
        // S('hooks', null);
        $status = model('addons')->save($data, ['id' => $id]);
        if ($status) {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
        // $this->resume('Addons', "id={$id}", $msg);
    }

    /**
     * 禁用插件
     */
    public function disable()
    {
        $id             = input('id');
        $msg            = array('success' => '禁用成功', 'error' => '禁用失败');
        $data['status'] = 0;
        $status         = model('addons')->save($data, ['id' => $id]);
        if ($status) {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
        // S('hooks', null);
        // $this->forbid('Addons', "id={$id}", $msg);
    }

    /**
     * 设置插件页面
     */
    public function config()
    {
        $id    = (int) input('id');
        $addon = db('addons')->find($id);
        if (!$addon) {
            $this->error('插件未安装');
        }

        $addon_class = get_addon_class($addon['name']);
        if (!class_exists($addon_class)) {
            trace("插件{$addon['name']}无法实例化,", 'ADDONS', 'ERR');
        }

        $data                   = new $addon_class;
        $addon['addon_path']    = $data->addon_path;
        $addon['custom_config'] = $data->custom_config;
        $this->meta_title       = '设置插件-' . $data->info['title'];
        $db_config              = $addon['config'];
        $addon['config']        = include $data->config_file;
        if ($db_config) {
            $db_config = json_decode($db_config, true);
            foreach ($addon['config'] as $key => $value) {
                if ($value['type'] != 'group') {
                    $addon['config'][$key]['value'] = $db_config[$key];
                } else {
                    foreach ($value['options'] as $gourp => $options) {
                        foreach ($options['options'] as $gkey => $value) {
                            $addon['config'][$key]['options'][$gourp]['options'][$gkey]['value'] = $db_config[$gkey];
                        }
                    }
                }
            }
        }
        $this->assign('data', $addon);
        if ($addon['custom_config']) {
            $this->assign('custom_config', $this->fetch($addon['addon_path'] . $addon['custom_config']));
        }
        // die;
        return $this->fetch();
        // $this->display();
    }

    /**
     * 保存插件设置
     */
    public function saveConfig()
    {
        $id     = (int) input('id');
        $config = input('config/a');

        $flag = db('addons')->where('id', $id)->setField('config', json_encode($config));

        if ($flag !== false) {
            return $this->success('保存成功', Cookie('__forward__'));
        } else {
            return $this->error('保存失败');
        }
    }

    /**
     * 卸载插件
     */
    public function uninstall()
    {
        $id = trim(input('id'));
        if (!$id) {
            return $this->error('参数错误');
        }

        $db_addons = db('addons')->find($id);
        // dump($data);
        // die;
        // $addonsModel = model('addons');

        // dump($db_addons);
        $class = get_addon_class($db_addons['name']);
        $this->assign('jumpUrl', url('index'));

        if (!$db_addons || !class_exists($class)) {
            $this->error('插件不存在');
        }

        session('addons_uninstall_error', null);
        $addons = new $class;

        $uninstall_flag = $addons->uninstall();

        if (!$uninstall_flag) {
            $this->error('执行插件预卸载操作失败' . session('addons_uninstall_error'));
        }

        $hooks_update = model('Hooks')->removeHooks($db_addons['name']);
        if ($hooks_update === false) {
            $this->error('卸载插件所挂载的钩子数据失败');
        }
        // S('hooks', null);
        $delete = model('addons')->where("name='{$db_addons['name']}'")->delete();
        if ($delete === false) {
            return $this->error('卸载插件失败');
        } else {
            return $this->success('卸载成功');
        }
    }

}
