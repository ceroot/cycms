<?php

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
