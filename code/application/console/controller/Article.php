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
 * @date      2016-06-25 16:54:44
 * @site      http://www.benweng.com
 */

namespace app\console\controller;

use app\common\model\Document;

class Article extends Base
{

    private $cate_id = null; //文档分类id

    /**
     * 分类文档列表页
     * @param integer $cate_id 分类id
     * @param integer $model_id 模型id
     * @param integer $position 推荐标志
     * @param integer $group_id 分组id
     */
    function list($cate_id = null, $model_id = null, $position = null, $group_id = null) {
        if ($cate_id === null) {
            $cate_id = $this->cate_id;
        }

        if (!empty($cate_id)) {
            $pid = input('pid', 0);
            if ($pid == 0) {
                $models = get_category($cate_id, 'model');

                // 获取分组定义
                $groups = get_category($cate_id, 'groups');
                if ($groups) {
                    $groups = parse_field_attr($groups);
                }
            } else {
                // 子文档列表
                $models = get_category($cate_id, 'model_sub');
            }

            if (is_null($model_id) && !is_numeric($models)) {
                // 绑定多个模型 取基础模型的列表定义
                $model = db('model')->getByName('document');
                // dump($model);
                $model_id = 1;
            } else {
                $model_id = $model_id ?: $models;
                //获取模型信息
                $model = db('Model')->getById($model_id);
                if (empty($model['list_grid'])) {
                    $model['list_grid'] = db('Model')->getFieldByName('document', 'list_grid');
                }
            }

            $this->assign('model', explode(',', $models));
        } else {
            // 获取基础模型信息
            $model    = db('model')->getByName('document');
            $model_id = null;
            $cate_id  = 0;
            $this->assign('model', null);
        }

        $attribute_list = db('attributeUserList')->where(['uid' => UID, 'model_id' => $model_id])->value('attribute');
        if (!$attribute_list) {
            $attribute_list = model('attribute')->where(['model_id' => $model_id, 'list_show' => 0])->column('title', 'name');
        } else {
            $attribute_arr      = explode(',', $attribute_list);
            $attribute_arr_temp = [];
            foreach ($attribute_arr as $value) {
                $value_temp         = model('attribute')->where('id', $value)->column('title', 'name');
                $attribute_arr_temp = array_merge($attribute_arr_temp, $value_temp);
            }
            $attribute_list = $attribute_arr_temp;
        }
        dump($attribute_list);
        // die;

        //解析列表规则
        $fields = array();
        $grids  = preg_split('/[;\r\n]+/s', trim($model['list_grid']));
        dump($grids);die;
        foreach ($grids as &$value) {
            // 字段:标题:链接
            $val = explode(':', $value);
            // dump($val);
            // 支持多个字段显示
            $field = explode(',', $val[0]);

            $value = array('field' => $field, 'title' => $val[1]);
            // dump($value);
            if (isset($val[2])) {
                // 链接信息
                $value['href'] = $val[2];
                // 搜索链接信息中的字段信息
                preg_replace_callback('/\[([a-z_]+)\]/', function ($match) use (&$fields) {$fields[] = $match[1];}, $value['href']);
            }
            if (strpos($val[1], '|')) {
                // 显示格式定义
                list($value['title'], $value['format']) = explode('|', $val[1]);
            }
            foreach ($field as $val) {
                $array    = explode('|', $val);
                $fields[] = $array[0];
            }
        }
        // dump($fields);die;
        // 文档模型列表始终要获取的数据字段 用于其他用途
        $fields[] = 'category_id';
        $fields[] = 'model_id';
        $fields[] = 'pid';

        // 过滤重复字段信息
        $fields = array_unique($fields);

        // 列表查询
        $list = $this->getDocumentList($cate_id, $model_id, $position, $fields, $group_id);
        // dump($list);die;
        // 列表显示处理
        $list = $this->parseDocumentList($list, $model_id);
        // dump($list);die;

        //
        $this->assign('model_id', $model_id);
        $this->assign('group_id', $group_id);
        $this->assign('position', $position);
        //$this->assign('groups', $groups);
        $this->assign('list', $list);
        $this->assign('list_grids', $grids);
        $this->assign('model_list', $model);

        return $this->fetch();

    }

    /**
     * 默认文档列表方法
     * @param integer $cate_id 分类id
     * @param integer $model_id 模型id
     * @param integer $position 推荐标志
     * @param mixed $field 字段列表
     * @param integer $group_id 分组id
     */
    protected function getDocumentList($cate_id = 0, $model_id = null, $position = null, $field = true, $group_id = null)
    {

        /* 查询条件初始化 */
        $map = array();
        if (isset($_GET['title'])) {
            $map['title'] = array('like', '%' . (string) I('title') . '%');
        }
        if (isset($_GET['status'])) {
            $map['status'] = I('status');
            $status        = $map['status'];
        } else {
            $status        = null;
            $map['status'] = array('in', '0,1,2');
        }
        if (isset($_GET['time-start'])) {
            $map['update_time'][] = array('egt', strtotime(I('time-start')));
        }
        if (isset($_GET['time-end'])) {
            $map['update_time'][] = array('elt', 24 * 60 * 60 + strtotime(I('time-end')));
        }
        if (isset($_GET['nickname'])) {
            $map['uid'] = db('user')->where(array('nickname' => input('nickname')))->getField('id');
        }

        // 构建列表数据
        $Document = db('Document');

        if ($cate_id) {
            $map['category_id'] = $cate_id;
        }
        $map['pid'] = input('pid', 0);
        if ($map['pid']) {
            // 子文档列表忽略分类
            unset($map['category_id']);
        }
        // dump($map);die;
        $Document->alias('DOCUMENT');
        if (!is_null($model_id)) {
            $map['model_id'] = $model_id;
            if (is_array($field) && array_diff($Document->getDbFields(), $field)) {
                $modelName = db('Model')->getFieldById($model_id, 'name');
                $Document->join('__DOCUMENT_' . strtoupper($modelName) . '__ ' . $modelName . ' ON DOCUMENT.id=' . $modelName . '.id');
                $key = array_search('id', $field);
                if (false !== $key) {
                    unset($field[$key]);
                    $field[] = 'DOCUMENT.id';
                }
            }
        }
        if (!is_null($position)) {
            $map[] = "position & {$position} = {$position}";
        }
        if (!is_null($group_id)) {
            $map['group_id'] = $group_id;
        }
        $list = db('Document')->where($map)->select();
        // dump($list);die;
        // $list = $this->lists($Document, $map, 'level DESC,DOCUMENT.id DESC', $field);

        if ($map['pid']) {
            // 获取上级文档
            $article = $Document->field('id,title,type')->find($map['pid']);
            $this->assign('article', $article);
        }
        //检查该分类是否允许发布内容
        $allow_publish = get_category($cate_id, 'allow_publish');

        $this->assign('status', $status);
        $this->assign('allow', $allow_publish);
        $this->assign('pid', $map['pid']);

        $this->meta_title = '文档列表';
        return $list;
    }

    public function document()
    {
        $data = Document::find(1); //->select();
        // $this->assign('data', $data);
        dump($data->toArray());
        // return $this->fetch();
    }

    /**
     * 处理文档列表显示
     * @param array $list 列表数据
     * @param integer $model_id 模型id
     */
    protected function parseDocumentList($list, $model_id = null)
    {

        $model_id = $model_id ? $model_id : 1;

        $attrList = get_model_attribute($model_id, false, 'id,name,type,extra');
        // dump($attrList);
        // 对列表数据进行显示处理
        if (is_array($list)) {

            foreach ($list as $k => $data) {

                foreach ($data as $key => $val) {
                    // dump($val);
                    if (isset($attrList[$key])) {
                        $extra = $attrList[$key]['extra'];
                        $type  = $attrList[$key]['type'];
                        // dump($type);
                        if ('select' == $type || 'checkbox' == $type || 'radio' == $type || 'bool' == $type) {
                            // 枚举/多选/单选/布尔型
                            $options = parse_field_attr($extra);
                            if ($options && array_key_exists($val, $options)) {
                                $data[$key] = $options[$val];
                            }
                        } elseif ('date' == $type) {
                            // 日期型
                            $data[$key] = date('Y-m-d', $val);
                        } elseif ('datetime' == $type) {
                            // 时间型
                            $data[$key] = date('Y-m-d H:i', $val);
                        }
                    }
                }
                $data['model_id'] = $model_id;
                $list[$k]         = $data;
            }
        }
        // dump($list);
        // die;
        return $list;
    }

}
