<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------

namespace addons\ycEditor;

use app\common\controller\Addon;

/**
 * 编辑器插件
 * @author yangweijie <yangweijiester@gmail.com>
 */

class YcEditorAddon extends Addon
{

    public $info = array(
        'name'        => 'YcEditor',
        'title'       => '测试编辑器',
        'description' => '测试编辑器，这是说明',
        'status'      => 1,
        'author'      => 'thinkphp',
        'version'     => '0.2',
    );

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    /**
     * 编辑器挂载的后台文档模型文章内容钩子
     * @param array('name'=>'表单name','value'=>'表单对应的值')
     */
    public function adminArticleEdit($data)
    {
        $this->assign('addons_data', $data);
        $this->assign('addons_config', $this->getConfig());
        $this->display('content');
    }

    public function ycArticleEdit($data)
    {
        $this->assign('addons_data', $data);
        $this->assign('addons_config', $this->getConfig());
        $this->display('content');
    }

    public function testEditor($data)
    {
        $this->assign('addons_data', $data);
        $this->assign('addons_config', $this->getConfig());
        $this->display('content');
    }

}
