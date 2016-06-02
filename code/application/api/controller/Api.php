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
 * @date      2016-06-02 10:12:02
 * @site      http://www.benweng.com
 */
namespace app\api\controller;

use think\controller\Rest;

class Api extends Rest
{

    public function index()
    {
        // return file_get_contents("php://input");REQUEST_METHOD

        $meth = strtolower(request()->method());
        // return $meth;
        switch ($meth) {
            case 'get':
                $this->_get();
                break;
            case 'post':
                // response(1);
                return $this->_post();
                break;
            case 'put':
                $this->_put();
                break;
            case 'delete':
                $this->_delete();
                break;
            case 'ajax':
                $this->_ajax();
                break;

            default:
                return 'This is api page.';
                break;
        }

    }

    protected function _get()
    {
        $table = input('get.table');
        if ($table) {
            $list = model($table);

            if ($list) {
                $list->select();
                // response($list);
                return $list;
            }
        } else {
            return 'This is api page.';
        }
    }

    protected function _post()
    {
        $table = input('get.table');
        $list  = db($table)->find(input('get.id'));
        return $list;
        //response(1);
    }

    protected function _delete()
    {
        response('delete');
    }

    protected function _ajax()
    {
        response('ajax');
    }

}
