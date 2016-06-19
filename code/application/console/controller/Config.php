<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Config.php[配置表控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-19 11:22:56
 * @site      http://www.benweng.com
 */

namespace app\console\controller;

use app\console\controller\Base;

class Config extends Base
{

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 根据配置类型解析配置
     * @param  integer $type  配置类型
     * @param  string  $value 配置值
     */
    private static function parse($type, $value)
    {
        switch ($type) {
            case 3: //解析数组
                $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if (strpos($value, ':')) {
                    $value = array();
                    foreach ($array as $val) {
                        list($k, $v) = explode(':', $val);
                        $value[$k]   = $v;
                    }
                } else {
                    $value = $array;
                }
                break;
        }
        return $value;
    }

    public function index()
    {
        $id = input('get.id');
        if (!$id) {
            return $this->error('数据错误');
        }
        if ($id == 5) {
            $id = '';
        }
        $list = $this->model->where(array('status' => 1, 'group' => $id))->field('id,name,title,extra,value,remark,type')->order('sort')->select();
        if (!$list) {
            return $this->error('没有数据');
        }
        if ($list) {
            $this->assign('one', $list);
        }

        return $this->fetch('group');
    }

    public function save($config)
    {
        if ($config && is_array($config)) {
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $this->model->where($map)->setField('value', $value);
            }
        }
        cache('db_config_data', null);
        return $this->success('保存成功！');
    }

    public function group($id)
    {
        if (!$id) {
            return $this->error('数据错误');
        }
        $list = $this->model->where(array('status' => 1, 'group' => $id))->field('id,name,title,extra,value,remark,type')->order('sort')->select();
        if ($list) {
            $this->assign('one', $list);
        }
        return $this->fetch();
    }

}
