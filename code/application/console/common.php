<?php

/* 解析列表定义规则*/

function get_list_field($data, $grid)
{
    dump($grid);

    // 获取当前字段数据
    foreach ($grid['field'] as $field) {

        $array = explode('|', $field);

        $temp = $data[$array[0]];
        // dump($temp);
        // 函数支持
        if (isset($array[1])) {
            $temp = call_user_func($array[1], $temp);
        }
        $data2[$array[0]] = $temp;
    }
    if (!empty($grid['format'])) {
        $value = preg_replace_callback('/\[([a-z_]+)\]/', function ($match) use ($data2) {return $data2[$match[1]];}, $grid['format']);
    } else {
        $value = implode(' ', $data2);
    }

    // 链接支持
    if ('title' == $grid['field'][0] && '目录' == $data['type']) {
        // 目录类型自动设置子文档列表链接
        $grid['href'] = '[LIST]';
    }
    if (!empty($grid['href'])) {
        $links = explode(',', $grid['href']);
        foreach ($links as $link) {
            $array = explode('|', $link);
            $href  = $array[0];
            if (preg_match('/^\[([a-z_]+)\]$/', $href, $matches)) {
                $val[] = $data2[$matches[1]];
            } else {
                $show = isset($array[1]) ? $array[1] : $value;
                // 替换系统特殊字符串
                $href = str_replace(
                    array('[DELETE]', '[EDIT]', '[LIST]'),
                    array('setstatus?status=-1&ids=[id]',
                        'edit?id=[id]&model=[model_id]&cate_id=[category_id]',
                        'index?pid=[id]&model=[model_id]&cate_id=[category_id]'),
                    $href);

                // 替换数据变量
                $href = preg_replace_callback('/\[([a-z_]+)\]/', function ($match) use ($data) {return $data[$match[1]];}, $href);

                $val[] = '<a href="' . url($href) . '">' . $show . '</a>';
            }
        }
        $value = implode(' ', $val);
    }
    return $value;
}

/**
 * 获取配置的类型
 * @param string $type 配置类型
 * @return string
 */
function get_config_type($type = 0)
{
    $list = config('config_type_list');
    return $list[$type];
}

/**
 * 获取配置的分组
 * @param string $group 配置分组
 * @return string
 */
function get_config_group($group = 0)
{
    $list = config('config_group_list');
    return $group ? $list[$group] : '';
}

// 获取属性类型信息
function get_attribute_type($type = '')
{
    // TODO 可以加入系统配置
    static $_type = array(
        'num'      => array('数字', 'int(10) UNSIGNED NOT NULL'),
        'string'   => array('字符串', 'varchar(255) NOT NULL'),
        'textarea' => array('文本框', 'text NOT NULL'),
        'date'     => array('日期', 'int(10) NOT NULL'),
        'datetime' => array('时间', 'int(10) NOT NULL'),
        'bool'     => array('布尔', 'tinyint(2) NOT NULL'),
        'select'   => array('枚举', 'char(50) NOT NULL'),
        'radio'    => array('单选', 'char(10) NOT NULL'),
        'checkbox' => array('多选', 'varchar(100) NOT NULL'),
        'editor'   => array('编辑器', 'text NOT NULL'),
        'picture'  => array('上传图片', 'int(10) UNSIGNED NOT NULL'),
        'file'     => array('上传附件', 'int(10) UNSIGNED NOT NULL'),
    );
    return $type ? $_type[$type][0] : $_type;
}

/**
 * 获取分类信息并缓存分类
 * @param  integer $id    分类ID
 * @param  string  $field 要获取的字段名
 * @return string         分类信息
 */
function get_category($id, $field = null)
{
    static $list;

    /* 非法分类ID */
    if (empty($id) || !is_numeric($id)) {
        return '';
    }

    /* 读取缓存数据 */
    if (empty($list)) {
        $list = cache('sys_category_list');
    }

    /* 获取分类名称 */
    if (!isset($list[$id])) {
        $cate = db('category')->find($id);
        if (!$cate || 1 != $cate['status']) {
            //不存在分类，或分类被禁用
            return '';
        }
        $list[$id] = $cate;
        cache('sys_category_list', $list); //更新缓存
    }
    // dump(cache('sys_category_list'));die;
    return is_null($field) ? $list[$id] : $list[$id][$field];
}

/**
 * 获取属性信息并缓存
 * @param  integer $id    属性ID
 * @param  string  $field 要获取的字段名
 * @return string         属性信息
 */
function get_model_attribute($model_id, $group = true, $fields = true)
{
    static $list;

    /* 非法ID */
    if (empty($model_id) || !is_numeric($model_id)) {
        return '';
    }

    /* 获取属性 */
    if (!isset($list[$model_id])) {
        $map    = array('model_id' => $model_id);
        $extend = db('model')->getFieldById($model_id, 'extend');

        if ($extend) {
            $map = array('model_id' => array("in", array($model_id, $extend)));
        }
        $info            = db('attribute')->where($map)->field($fields)->select();
        $list[$model_id] = $info;
    }

    $attr = array();
    if ($group) {
        foreach ($list[$model_id] as $value) {
            $attr[$value['id']] = $value;
        }
        $model     = M("Model")->field("field_sort,attribute_list,attribute_alias")->find($model_id);
        $attribute = explode(",", $model['attribute_list']);
        if (empty($model['field_sort'])) {
            //未排序
            $group = array(1 => array_merge($attr));
        } else {
            $group = json_decode($model['field_sort'], true);

            $keys = array_keys($group);
            foreach ($group as &$value) {
                foreach ($value as $key => $val) {
                    $value[$key] = $attr[$val];
                    unset($attr[$val]);
                }
            }

            if (!empty($attr)) {
                foreach ($attr as $key => $val) {
                    if (!in_array($val['id'], $attribute)) {
                        unset($attr[$key]);
                    }
                }
                $group[$keys[0]] = array_merge($group[$keys[0]], $attr);
            }
        }
        if (!empty($model['attribute_alias'])) {
            $alias  = preg_split('/[;\r\n]+/s', $model['attribute_alias']);
            $fields = array();
            foreach ($alias as &$value) {
                $val             = explode(':', $value);
                $fields[$val[0]] = $val[1];
            }
            foreach ($group as &$value) {
                foreach ($value as $key => $val) {
                    if (!empty($fields[$val['name']])) {
                        $value[$key]['title'] = $fields[$val['name']];
                    }
                }
            }
        }
        $attr = $group;
    } else {
        foreach ($list[$model_id] as $value) {
            $attr[$value['name']] = $value;
        }
    }
    return $attr;
}
