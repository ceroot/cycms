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
 * @date      2016-06-24 15:12:02
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class Model extends Base
{

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    public function edit()
    {
        $id = input('get.id');
        if (!$id) {
            return $this->error('参数错误');
        }
        $data = $this->model->find($id);
        if (!$data) {
            return $this->error($this->model->getError());
        }

        $attribute_list         = [];
        $attribute_list         = empty($data['attribute_list']) ? $attribute_list : explode(",", $data['attribute_list']);
        $data['attribute_list'] = $attribute_list;
        // $data['attribute_list'] = empty($data['attribute_list']) ? '' : explode(",", $data['attribute_list']);
        $fields = db('Attribute')->where(array('model_id' => $data['id']))->column('id,name,title,is_show');

        $fields = empty($fields) ? array() : $fields;
        // 是否继承了其他模型
        if ($data['extend'] != 0) {
            $extend_fields = db('Attribute')->where(array('model_id' => $data['extend']))->column('id,name,title,is_show');
            $fields += $extend_fields;
        }

        // 梳理属性的可见性
        foreach ($fields as $key => $field) {
            if (!empty($data['attribute_list']) && !in_array($field['id'], $data['attribute_list'])) {
                $fields[$key]['is_show'] = 0;
            }
        }

        // 获取模型排序字段
        // dump($data['field_sort']);
        $field_sort = json_decode($data['field_sort'], true);
        // dump($field_sort);
        if (!empty($field_sort)) {
            foreach ($field_sort as $group => $ids) {
                // dump($group);
                // dump($ids);
                foreach ($ids as $key => $value) {
                    $fields[$value]['group'] = $group;
                    $fields[$value]['sort']  = $key;
                }
            }
        }
        // dump($fields);die;
        // 模型字段列表排序
        // $fields = list_sort_by($fields, "sort");
        // dump($data);
        // dump($fields);
        // die;
        $this->assign('fields', $fields);
        $this->assign('one', $data);

        return $this->fetch();
    }

}
