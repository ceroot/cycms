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

    protected $beforeActionList = [
        'add_before' => ['only' => 'add'],
    ];

    protected function add_before()
    {
        $hooks = model('hooks')->field('name,description')->select();
        $this->assign('hooks', $hooks);
    }

    /**
     * 插件首页
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
     * 插件列表
     */
    function list() {
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
        return $this->fetch();
    }

    //创建向导首页
    public function create()
    {
        // if (!is_writable(ONETHINK_ADDON_PATH)) {
        //     $this->error('您没有创建目录写入权限，无法使用此功能');
        // }

        $hooks = model('hooks')->field('name,description')->select();
        // dump($hooks);
        $this->assign('hooks', $hooks);
        $this->meta_title = '创建向导';
        return $this->fetch();
        // $this->display('create');
    }

    //预览
    public function preview($output = true)
    {
        $data                   = $_POST;
        $data['info']['status'] = (int) $data['info']['status'];
        $extend                 = array();
        $custom_config          = trim($data['custom_config']);
        if ($data['has_config'] && $custom_config) {
            $custom_config = <<<str


        public \$custom_config = '{$custom_config}';
str;
            $extend[] = $custom_config;
        }

        $admin_list = trim($data['admin_list']);
        if ($data['has_adminlist'] && $admin_list) {
            $admin_list = <<<str


        public \$admin_list = array(
            {$admin_list}
        );
str;
            $extend[] = $admin_list;
        }

        $custom_adminlist = trim($data['custom_adminlist']);
        if ($data['has_adminlist'] && $custom_adminlist) {
            $custom_adminlist = <<<str


        public \$custom_adminlist = '{$custom_adminlist}';
str;
            $extend[] = $custom_adminlist;
        }

        $extend = implode('', $extend);
        $hook   = '';
        foreach ($data['hook'] as $value) {
            $hook .= <<<str
        //实现的{$value}钩子方法
        public function {$value}(\$param){

        }

str;
        }

        $tpl = <<<str
<?php

namespace addons\\{$data['info']['name']};
use app\common\controller\Addon;

/**
 * {$data['info']['title']}插件
 * @author {$data['info']['author']}
 */

    class {$data['info']['name']}Addon extends Addon{

        public \$info = array(
            'name'=>'{$data['info']['name']}',
            'title'=>'{$data['info']['title']}',
            'description'=>'{$data['info']['description']}',
            'status'=>{$data['info']['status']},
            'author'=>'{$data['info']['author']}',
            'version'=>'{$data['info']['version']}'
        );{$extend}

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

{$hook}
    }
str;
        if ($output) {
            exit($tpl);
        } else {
            return $tpl;
        }

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
        cache('hooks', null);
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
        // 清除钩子缓存
        cache('hooks', null);
        $status = model('addons')->save($data, ['id' => $id]);
        if ($status) {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }

        // $this->forbid('Addons', "id={$id}", $msg);
    }

    /**
     * 设置插件页面
     */
    public function config()
    {
        $id = (int) input('id');
        if (!$id) {
            return $this->error('参数错误');
        }
        $addon = db('addons')->find($id); // 取得数据库数据
        if (!$addon) {
            return $this->error('插件未安装');
        }

        $addon_class = get_addon_class($addon['name']);
        if (!class_exists($addon_class)) {
            trace("插件{$addon['name']}无法实例化,", 'ADDONS', 'ERR');
        }

        $data                   = new $addon_class; // 实例化
        $addon['addon_path']    = $data->addon_path; // 插件路径
        $addon['custom_config'] = $data->custom_config;
        $this->meta_title       = '设置插件-' . $data->info['title'];
        $db_config              = $addon['config']; // 取得用户设置配置
        $addon['config']        = include $data->config_file; // 读取插件初始配置

        if ($db_config) {
            $db_config = json_decode($db_config, true);
            foreach ($addon['config'] as $key => $value) {
                if ($value['type'] != 'group') {
                    $addon['config'][$key]['value'] = $db_config[$key];

                } else {
                    foreach ($value['options'] as $gourp => $options) {
                        // dump($db_config);
                        foreach ($options['options'] as $gkey => $value) {
                            // dump($gkey);

                            $addon['config'][$key]['options'][$gourp]['options'][$gkey]['value'] = $db_config[$gkey];
                        }
                    }
                }
            }
        }
        $this->assign('data', $addon);
        // $addon['custom_config'] = 1;
        if ($addon['custom_config']) {
            $addon_name = $addon['name'];
            // $custom_config_file_path = CODE_PATH . 'addons/' . strtolower($addon_name) . '/view/config.' . config('url_html_suffix');
            // $this->assign('custom_config', $this->fetch($addon['addon_path'] . $addon['custom_config']));
            // $custom_config_code = file_get_contents($custom_config_file_path);
            $custom_config_path = strtolower($addon_name) . '://' . $addon_name . '/config';
            $custom_config_path = addons_url($custom_config_path);
            $this->assign('custom_config_path', $custom_config_path);
            // $this->assign('custom_config', $custom_config_code);

            return $this->fetch(CODE_PATH . 'addons/' . strtolower($addon_name) . '/view/config.html');

        } else {
            return $this->fetch();
        }

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
     * 安装插件
     */
    public function install()
    {
        $addon_name = trim(input('addon_name'));
        $class      = get_addon_class($addon_name);
        if (!class_exists($class)) {
            $this->error('插件不存在');
        }

        $addons = new $class;
        $info   = $addons->info;
        if (!$info || !$addons->checkInfo()) //检测信息的正确性
        {
            $this->error('插件信息缺失');
        }

        session('addons_install_error', null);
        $install_flag = $addons->install();
        if (!$install_flag) {
            $this->error('执行插件预安装操作失败' . session('addons_install_error'));
        }
        $addonsModel = model('addons');
        // $data        = $addonsModel->create($info);
        if (is_array($addons->admin_list) && $addons->admin_list !== array()) {
            $info['has_adminlist'] = 1;
        } else {
            $info['has_adminlist'] = 0;
        }

        if (!$info) {
            $this->error($addonsModel->getError());
        }

        if ($addonsModel->save($info)) {
            $config = json_encode($addons->getConfig());
            // $st = $addonsModel->save(['config' => $config], ['id' => $status]);
            db('addons')->where('name', $addon_name)->setField('config', $config);
            $hooks_update = model('Hooks')->updateHooks($addon_name);
            if ($hooks_update) {
                // S('hooks', null);
                cache('hooks', null);
                return $this->success('安装成功');
            } else {
                $addonsModel->where("name='{$addon_name}'")->delete();
                return $this->error('更新钩子处插件失败,请卸载后尝试重新安装');
            }

        } else {
            return $this->error('写入插件数据失败');
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
        cache('hooks', null);
        $delete = model('addons')->where("name='{$db_addons['name']}'")->delete();
        if ($delete === false) {
            return $this->error('卸载插件失败');
        } else {
            return $this->success('卸载成功');
        }
    }

    /**
     * 钩子列表
     */
    public function hooks()
    {
        $this->meta_title = '钩子列表';
        $map              = $fields              = array();
        // $list             = $this->lists(model("Hooks")->field($fields), $map);
        $list = model("Hooks")->select();
        // dump($list);
        // int_to_string($list, array('type' => config('HOOKS_TYPE')));
        // 记录当前列表页的cookie
        Cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->assign('list', $list);
        return $this->fetch();

    }

    // 访问插件地址生成
    public function execute($_addons = null, $_controller = null, $_action = null)
    {
        if (config('URL_CASE_INSENSITIVE')) {
            $_addons     = ucfirst(parse_name($_addons, 1));
            $_controller = parse_name($_controller, 1);
        }

        $TMPL_PARSE_STRING                  = config('view_replace_str');
        $TMPL_PARSE_STRING['__ADDONROOT__'] = CODE_PATH . "/addons/{$_addons}";
        config('view_replace_str', $TMPL_PARSE_STRING);

        if (!empty($_addons) && !empty($_controller) && !empty($_action)) {
            // $Addons = controller("addons://{$_addons}/{$_controller}")->$_action();
            $class  = "\\addons\\{$_addons}\\controller\\{$_controller}";
            $Addons = new $class;
            $Addons->$_action();
            // dump($ddd);
        } else {
            $this->error('没有指定插件名称，控制器或操作！');
        }
    }

    public function addontest()
    {
        $url = addons_url('EditorForAdmin://Upload/ue_upimg');
        dump($url);
        dump('end');
    }

}
