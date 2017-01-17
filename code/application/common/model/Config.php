<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Config.php[配置表模型]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-19 12:28:02
 * @site      http://www.benweng.com
 */

namespace app\common\model;

use app\common\model\Extend;

class Config extends Extend
{
    public function getGroupTextAttr($value, $data)
    {
        $group    = config('config_group_list');
        $group[0] = '不分组';
        return $group[$data['group']];
    }

    public function getTypeTextAttr($value, $data)
    {
        $type = config('config_type_list');
        return $type[$data['type']];
    }

    public function cache_config()
    {
        $map  = array('status' => 1);
        $data = $this->where($map)->field('type,name,value')->select();

        $config = array();
        if ($data && is_array($data)) {
            foreach ($data as $value) {
                $config[$value['name']] = self::parse($value['type'], $value['value']);
            }
        }
        return $config;
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
}
