<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  AuthRule.php[规则表模型]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-03-31 14:49:22
 * @site      http://www.benweng.com
 */
namespace app\console\model;

use think\Model;
use third\Data;

class AuthRule extends Model
{

    // 自动完成
    protected $auto = [];

    public function getStatusTextAttr($value, $data)
    {
        $status = [0 => '禁用', 1 => '正常'];
        return $status[$data['status']];
    }

    // public function __construct()
    // {
    //     if (!cache('authrule')) {
    //         $this->updateCache();
    //     }
    //     $this->cache = cache('authrule'); // 从缓存里取得规则数据
    // }
    public function getAll($isArray = 0)
    {
        $cache = cache('authrule');
        if ($isArray) {
            return Data::channelLevel($cache, 0, '', 'id', 'pid');
        } else {
            return Data::tree($cache, 'title', 'id', 'pid');
        }
    }

    /**
     * [update_cache 更新缓存]
     * @return [type] [description]
     */
    public function updateCache()
    {
        // $data = db('authRule')->order(['sort' => 'asc', 'id' => 'asc'])->select();
        $data = $this->order(['sort' => 'asc', 'id' => 'asc'])->select();
        cache('authrule', $data);
        $this->updateCacheAuthModel();

    }
    /**
     * [update_cache_auth_model 更新不需要权限验证的控制器、方法和不需要实例化模型缓存]
     * @return [type]       [description]
     */
    public function updateCacheAuthModel()
    {
        // 这里使用cache('authrule')来取得数据，之因为不使用 $this->cache 是有原因的，切记，以免更新缓存不成功
        foreach (cache('authrule') as $val) {
            $auth          = $val['auth']; // 需要进行权限验证标记
            $status        = $val['status'];
            $controller    = $val['controller']; // 是控制器标记
            $instantiation = $val['instantiation']; // 需要实例化模型标记
            // 取得不需要进行权限验证
            if (!$auth && $status) {
                $data['not_auth'][] = strtolower($val['name']);
            }
            // 取得不需要实例化模型的控制器名称
            if ($controller && !$instantiation) {
                $name                       = explode('/', $val['name']);
                $name                       = $name[0];
                $data['not_d_controller'][] = $name;
            }
        }
        // return $data;
        cache('authModel', $data);
    }

    /**
     * [_level 级别自动完成]
     * @return [type] [description]
     */
    protected function _level()
    {
        $pid = I('post.pid');
        if ($pid == 0) {
            return 1;
        } else {
            $data = $this->where(array('id' => $pid))->find();
            return $data['level'] + 1;
        }
    }
    /**
     * [getOne 查找一条记录]
     * @return [type] [description]
     */
    public function getOne($id)
    {
        $cache = cache('authrule');
        return isset($cache[$id]) ? $cache[$id] : null;
    }
    /**
     * [del 删除规则]
     * @return [type] [description]
     */
    public function del($id)
    {

        $count = db('authRule')->where('pid', $id)->count();
        if ($count) {
            $this->error = '请先删除子规则';
            return false;
        }
        $status = db('authRule')->delete($id);
        if ($status) {
            $this->updateCache();
            return true;
        } else {
            $this->error = '根据条件没有数据可进行删除';
            return false;
        }

    }
    /**
     * [update_sort 更新排序]
     * @param  [type] $cid   [description]
     * @param  [type] $sort [description]
     * @return [type]       [description]
     */
    public function updateSort($ids, $sort)
    {
        foreach ($ids as $k => $v) {
            $this->save(array('sort' => $sort[$k], 'id' => $v));
        }
        $this->updateCache();
        return true;
    }
    /**
     * [admin_menu 生成后台菜单并缓存]
     * @return [type] [description]
     */
    public function consoleMenu()
    {
        $cache = cache('authrule');

        // 判断是不是超级管理员
        if (in_array(UID, config('auth_superadmin'))) {
            $data = $cache;
        } else {
            // 根据用户id来选择id所对应的用户拥有的显示数据
            // 满足条件
            // 1 权限管理所拥有的
            // 2 不需要进行权限验证的
            $authModel = cache('authModel'); // 从缓存取得不需要进行权限验证的数据
            // dump($authModel);
            $data = array();
            foreach ($cache as $value) {
                if (authCheck($value['name'], UID) || in_array(strtolower($value['name']), $authModel['not_auth'])) {
                    $data[] = $value;
                }
            }
        }

        $navdata = array();
        foreach ($data as $value) {
            if ($value['status']) {
                // 激活当前处理
                $value['active'] = 0;
                $controller      = toCamel(CONTROLLER_NAME);
                $action          = toCamel(ACTION_NAME);

                // 取得当前控制器id与方法id
                if (strtolower($value['name']) == strtolower($controller . '/' . $action)) {
                    $currentData = [
                        'action_id'     => $value['id'],
                        'controller_id' => $value['pid'],
                    ];
                }

                switch ($value['name']) {
                    case 'index/index':
                        $time = date('YmdHis') . getrandom(128);
                        $url  = url('console/index/index?time=' . $time);
                        # code...
                        break;
                    case 'manager/log': // 管理员管理
                        // $name = url($name, array('role' => 1));
                        $url = url('actionLog/list', array('role' => 1));
                        break;
                    case 'UserComment/index': // 评论管理
                        $url = url($name, array('verifystate' => 1));
                        break;
                    case '':
                        $url = '';
                        break;
                    default:
                        $url = url($value['name']);
                }
                $value['url'] = $url;
                $navdata[]    = $value;
            }
        }

        // 处理当前高亮标记
        if (isset($currentData['action_id'])) {
            // 子级返回父级数组
            $bread = getParents($navdata, $currentData['action_id']);

            // 只取id组成数组
            $activeidarr = array();
            foreach ($bread as $value) {
                $activeidarr[] = $value['id'];
            }
            // 高亮标识
            $activedata = array();
            foreach ($navdata as $value) {
                if (in_array($value['id'], $activeidarr)) {
                    $value['active'] = 1;
                }
                $activedata[] = $value;
            }
            // 子菜单
            $second = null;
            if (count($activeidarr) > 2) {
                foreach ($activedata as $value) {
                    if ($currentData['controller_id'] == $value['id']) {
                        $producttitle = $value['title'];
                        break;
                    }
                }
                $second['title'] = $producttitle;
                $second['data']  = getCateByPid($activedata, $currentData['controller_id']);
            } else {
                foreach ($activedata as $value) {
                    if ($currentData['action_id'] == $value['id']) {
                        $producttitle = $value['title'];
                        break;
                    }
                }
                $second['title'] = $producttitle;
                $second['data']  = getChiIds($navdata, $currentData['action_id']);
            }
            $treeArray['second']    = $second; // 二级菜单数据
            $treeArray['bread']     = $bread; // 面包萱
            $treeArray['showtitle'] = end($bread)['title']; // 当前标题
        } else {
            $this->getError('规则表里不存在此名称，请先进行规则添加');
            return false;
        }

        // 去掉不需要显示的
        $showData = array();
        foreach ($activedata as $key => $value) {
            if ($value['isnavshow'] == 1) {
                $showData[] = $value;
            }
        }
        $treeArray['menu'] = getCateTreeArr($showData, 0); // 生成树形结构$showData
        return $treeArray;
    }

    // protected $beforeActionList = [
    //     'first',
    //     'second'=>  ['except'=>'hello'],
    //     'three' =>  ['only'=>'hello,data'],
    // ];
    // /**
    //  * [_after_insert 添加后置方法]
    //  * @param  [type] $data    [description]
    //  * @param  [type] $options [description]
    //  * @return [type]          [description]
    //  */
    // public function _after_insert($data,$options)
    // {
    //     // 更新缓存
    //     $this->update_cache();
    // }
    // /**
    //  * [_after_update 更新后置方法]
    //  * @param  [type] $data    [description]
    //  * @param  [type] $options [description]
    //  * @return [type]          [description]
    //  */
    // public function _after_update($data,$options)
    // {
    //     // 更新缓存
    //     $this->update_cache();
    // }
}
