<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename  Developer.php[开发管理控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-05-28 11:43:30
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\common\api\ConfigApi;
use app\common\api\Data;
use app\console\controller\Base;

class Developer extends Base
{
    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    protected $beforeActionList = [
        'del_before' => ['only' => 'del'],
    ];

    public function update($action_log = null)
    {
        if (request()->isAjax()) {
            $data = input('post.');
            $pk   = $this->model->getPk();

            // 判断是新增还是更新，如果有键值就是更新，如果没有键值就是新增
            if ($data[$pk]) {

                $result = $this->validate($data, request()->controller());

                if ($result !== true) {
                    return $this->error($result);
                }

                $contentForm = $data['content'];
                if ($contentForm) {
                    $contentSql = $this->model->where('id', $data[$pk])->value('content');
                    if (!empty($contentSql)) {
                        // 对比判断并删除操作
                        $del_file = del_file($contentForm, $contentSql);
                    }
                }

                // 对 ueditor 内容数据的处理
                $data['content'] = ueditor_handle($data['content'], $data['title']);

                // 保存
                $status = $this->model->save($data, [$pk => $data[$pk]]);

                // 取得日志标记
                if (is_null($action_log)) {
                    $action_log = request()->controller() . '_edit'; // 日志记录标记
                    $record_id  = $data[$pk]; // 数据id
                }

                $msg = '修改成功';
            } else {
                // 数据验证并保存
                $status = $this->model->validate(true)->save($data);

                // 取得日志标记
                if (is_null($action_log)) {
                    $action_log = request()->controller() . '_add'; // 日志记录标记
                    $record_id  = $status; // 数据id
                }

                $msg = '添加成功';
            }
            // return $status;

            // 数据验证不通过返回提示
            if ($status === false) {
                return $this->error($this->model->getError());
            }

            // 是否成功返回
            if ($status) {

                action_log($record_id, $action_log); // 记录日志
                $url = cookie('__forward__'); // 取得跳转url
                return $this->success($msg, $url);
            } else {
                return $this->error('操作失败');
                // return $this->model->getError();
            }
        } else {
            return $this->error('数据有误');
        }
    }

    protected function del_before()
    {
        $pk      = $this->model->getPk();
        $id      = input('get.' . $pk);
        $content = $this->model->getFieldById($id, 'content');
        $pattern = '<img.*?src="(.*?)">';
        preg_match_all($pattern, $content, $matches);
        foreach ($matches[1] as $value) {
            $arr  = parse_url($value);
            $path = $arr['path'];
            if (file_exists('.' . $path)) {
                unlink('.' . $path);
            }
        }

    }

    public function view()
    {
        $id  = input('get.id');
        $one = $this->model->find($id);
        $this->assign('one', $one);
        return $this->fetch();
    }

    public function test()
    {
        $id  = 1;
        $one = db(request()->controller())->find($id);
        // dump($one);
        $this->assign('one', $one);
        return $this->fetch();
    }

    public function test2()
    {
        // $dd = new \application\common\common\ConfigApi();
        $ddd     = new \third\Data();
        $ddd     = new \application\api\Data();
        $dataobj = Data::yc();
        $confobj = ConfigApi::yc();
        dump($confobj);die;
        $obj = new common\api\Data();
        die;
        $config = api('Config/lists');
        dump($config);
    }
}
