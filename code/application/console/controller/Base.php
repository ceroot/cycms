<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Base.php[控制台基础控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-27 11:10:25
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\common\controller\Extend;

class Base extends Extend
{
    protected $model;
    protected $pk;
    protected $id;
    /**
     * @name   _initialize          [初始化]
     * @author SpringYang <ceroot@163.com>
     */
    public function _initialize()
    {
        parent::_initialize();
        // 定义UID
        define('UID', session('userid'));

        if (!UID) {
            $redirecturl = url('console/login/index') . '?backurl=' . getbackurl();
            $this->error('请登录', $redirecturl, 0);
            exit;
        }

        $manager = db('manager')->find(UID);

        // 锁定判断
        if ($manager['status'] == 0) {
            model('manager')->clearSession(); // 清除 session
            $redirecturl = url('console/login/index') . '?backurl=' . getbackurl();
            $this->error('账号被锁定，请联系管理员', $redirecturl);
            exit;
        }
        // model('authRule')->updateCache();die;
        // 生成不需要进行权限验证的和不需要实例化模型的控制器缓存
        if (!cache('authModel')) {
            model('authRule')->updateCache();
        }

        // 读取不需要进行权限验证的和不需要实例化模型的控制器缓存
        $authModel = cache('authModel');
        $authName  = CONTROLLER_NAME . '/' . ACTION_NAME;

        // 验证权限
        // 满足条件
        // 1 不是超级管理员
        // 2 是必须验证的
        if (!in_array(UID, config('auth_superadmin')) && !in_array($authName, $authModel['not_auth'])) {
            // 处理会员和管理员规则
            $controller = CONTROLLER_NAME;
            if ($controller == 'user' && input('role') == 1) {
                $controller = 'manager';
            }

            // 权限验证
            $authName = toCamel($controller) . '/' . ACTION_NAME;
            // 执行验证
            if (!authCheck($authName, UID)) {
                return $this->error('您没有相关权限，请联系管理员', url('index/index'));
            }
        }
        // dump(1);die;
        // 取得控制器名称
        // if (!in_array(CONTROLLER_NAME, $authModel['not_d_controller'])) {
        //     $this->model = model(CONTROLLER_NAME);
        // }
        // dump($authModel['instantiation_controller']);die;
        // dump(toCamel(CONTROLLER_NAME));
        // dump($authModel);
        // die;
        if (in_array(strtolower(toUnderline(CONTROLLER_NAME)), $authModel['instantiation_controller'])) {
            $this->model = model(CONTROLLER_NAME);

            $this->pk = $this->model->getPk(); // 取得主键字段名
            //$id = input('get.' . $this->pk);
            $this->id = input($this->pk);
        }

        // 读取数据库中的配置[这里放置到行为里了]
        // $config = cache('db_config_data');
        // if (empty($config)) {
        //     $config = model('config')->cache_config();
        //     cache('db_config_data', $config);
        //     // dump(1);
        // }
        // config($config); //添加配置

        // 菜单输出
        $menu = model('AuthRule')->consoleMenu();
        $this->assign('menu', $menu); // 一级菜单输出
        $this->assign('second', $menu['second']); // 二级菜单输出
        $this->assign('title', $menu['showtitle']); // 标题输出
        $this->assign('bread', $menu['bread']); // 面包输出
        $this->assign('manager', $manager); // 管理员信息输出
    }

    /**
     * @name   basetest             [基本测试]
     * @param  string   $string     [说明]
     * @return boolean              [返回布尔值]
     * @author SpringYang <ceroot@163.com>
     */
    public function basetest()
    {

    }

    /**
     * @name   index                [通用index方法]
     * @author SpringYang <ceroot@163.com>
     */
    public function index()
    {
        return $this->fetch('common/index');
    }

    /**
     * @name   list                 [通用list方法]
     * @param  string   $string     [说明]
     * @return boolean              []
     * @author SpringYang <ceroot@163.com>
     */
    function list() {
        $pageLimit = input('get.limit');
        $pageLimit = isset($pageLimit) ? $pageLimit : config('paginate.list_rows'); //15; // 每页显示数目
        if (!$this->model) {
            return $this->error('请增加控制规则', url('authRule/add'));
        }

        $order = [
            $this->pk => 'desc',
        ];

        $map = [];

        // 各种条件
        switch (request()->controller()) {
            case 'config':
                $order = [
                    'group' => 'desc',
                ];
                break;
            case 'attribute':
                $model_id        = input('get.model_id');
                $map['model_id'] = $model_id;
                break;
            default:
                # code...
                break;
        }

        $list = $this->model->where($map)->order($order)->paginate($pageLimit);
        // dump($list);die;
        $page = $list->render();
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('page', $page);

        cookie('__forward__', $_SERVER['REQUEST_URI']); // 记录当前列表页的cookie
        return $this->fetch();
    }

    /**
     * @name   add                  [通用添加方法]
     * @author SpringYang <ceroot@163.com>
     */
    public function add()
    {
        //dump(request()->controller());die;
        $this->assign('one', null);
        return $this->fetch();
    }

    /**
     * @name   edit                 [通用编辑方法]
     * @author SpringYang <ceroot@163.com>
     */
    public function edit()
    {
        if (!$this->id) {
            return $this->error('参数错误');
        } else {
            $one = db(request()->controller())->find($this->id);
            $this->assign('one', $one);
            return $this->fetch('add');
        }
    }

    /**
     * @name   update                 [通用更新数据操作方法]
     * @author SpringYang <ceroot@163.com>
     */
    public function update($action_log = null)
    {
        if (request()->isAjax()) {
            $data = input('param.');
            // $sort = $data['field_sort'];
            // $sort = json_encode($sort);
            //return $data;

            // 判断是新增还是更新，如果有键值就是更新，如果没有键值就是新增
            if ($data[$this->pk]) {
                // 角色分配的时候对数据的处理
                switch (request()->controller()) {
                    case 'auth_group':
                        $rulesdata = input('param.rules/a');
                        if ($rulesdata) {
                            $data['rules'] = implode(',', $rulesdata);
                            session('log_text', '修改了权限');
                        } else {
                            session('log_text', '编辑了角色');
                        }
                        break;
                    case 'manager': // 管理员修改时对密码的处理
                        if (empty($data['password'])) {
                            unset($data['password']);
                        } else {
                            if (strlen($data['password']) < 6) {
                                return $this->error('密码长度不够');
                            }
                            $data['password'] = md5($data['username'] . $data['password']);
                        }
                        break;
                    case 'model':
                        if (input('param.field_sort/a')) {
                            $data['field_sort'] = json_encode($data['field_sort']);
                        }
                        if (input('param.attribute_list/a')) {
                            $data['attribute_list'] = arr2str($data['attribute_list']);
                        } else {
                            $data['attribute_list'] = '';
                        }
                        break;
                    case '':
                        # code...
                        break;
                    default:
                        # code...
                        break;
                }
                // return $data;
                // 验证状态设置
                $validate = request()->controller() . '.edit';
                if (input('param.rule')) {
                    if (input('param.rule') == 1) {
                        $validate = false;
                    }
                }

                // 数据验证并保存
                $status = $this->model->validate($validate)->save($data, [$this->pk => $data[$this->pk]]);

                // 取得日志标记
                if (is_null($action_log)) {
                    $action_log = request()->controller() . '_edit'; // 日志记录标记
                    $record_id  = $data[$this->pk]; // 数据id
                }
            } else {
                // 数据验证并保存
                $status = $this->model->validate(true)->save($data);

                // 取得日志标记
                if (is_null($action_log)) {
                    $action_log = request()->controller() . '_add'; // 日志记录标记
                    $record_id  = $status; // 数据id
                }
            }
            // return $status;

            // 数据验证不通过返回提示
            if ($status === false) {
                return $this->error($this->model->getError());
            }

            // 是否成功返回
            if ($status) {
                switch (request()->controller()) {
                    case 'AuthRule': // 更新规则缓存
                        $this->model->updateCache();
                        // 新增时是否添加日志记录标记
                        if (!$data[$this->pk]) {
                            model('action')->add_for_rule();
                        }
                        break;
                    case 'manager': // 管理员操作时的操作
                        model('AuthGroupAccess')->saveData($record_id);
                        break;
                    case 'config': // 清空配置数据缓存
                        cache('db_config_data', null);
                        break;
                    case 'model': // 清除模型缓存数据
                        cache('document_model_list', null);
                        break;
                    default:
                        # code...
                        break;
                }

                action_log($record_id, $action_log); // 记录日志

                return $this->success($data[$this->pk] ? '修改成功' : '新增成功', cookie('__forward__'));
            } else {
                return $this->error('操作失败');
                // return $this->model->getError();
            }
        } else {
            return $this->error('数据有误');
        }
    }

    // 查看详情
    /**
     * @name   view                 [通用查看详情方法]
     * @author SpringYang <ceroot@163.com>
     */
    public function view()
    {
        if (!$this->id) {
            return $this->error('参数错误');
        }

        if (request()->isAjax()) {

        } else {
            $one = $this->model->find($this->id);
            $this->assign('one', $one);
            return $this->fetch();
        }
    }

    /**
     * @name   del                  [通用删除方法]
     * @return boolean              [返回布尔值]
     * @author SpringYang <ceroot@163.com>
     */
    public function del()
    {
        $status = db(CONTROLLER_NAME)->delete($this->id);

        if ($status) {
            if (CONTROLLER_NAME == 'manager') {
                model('authGroupAccess')->delDataByUid($this->id);
            }

            if (CONTROLLER_NAME == 'auth_group') {
                model('authGroupAccess')->delDataByGid($this->id);
            }

            if (CONTROLLER_NAME == 'auth_rule') {
                $this->model->updateCache();
            }
            action_log($this->id); // 记录日志
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
        return $redata;
    }

    /**
     * @name   updatestatus         [通用更新 status 字段状态]
     * @return boolean              [返回布尔值]
     * @author SpringYang <ceroot@163.com>
     */
    public function updatestatus()
    {
        if (!$this->id) {
            return $this->error('参数错误');
        }

        $value          = db(request()->controller())->getFieldById($this->id, 'status');
        $data['status'] = $value ? 0 : 1;
        $status         = $this->model->save($data, [$this->pk => $this->id]);
        if ($status) {
            if (request()->controller() == 'auth_rule') {
                $this->model->updateCache();
            }
            action_log($this->id); // 记录日志

            return $this->success('操作成功');
        } else {
            return $this->error('操作失败');
            // return $this->model->getError();
        }
    }

    /**
     * @name   set         [通用设置]
     * @author SpringYang <ceroot@163.com>
     */
    public function set()
    {
        if (request()->isAjax()) {

        } else {
            return $this->fetch();
        }
    }

}
