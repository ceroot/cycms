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
        // response(REQUEST_METHOD);
        // return REQUEST_METHOD;
        // if (input('get.table')) {

        if (IS_GET) {
            $this->_get();
        }
        if (IS_POST) {
            $this->_post();
        }
        if (IS_PUT) {
            $this->_put();
        }
        if (IS_DELETE) {
            $this->_delete();
        }
        if (IS_AJAX) {
            $this->_ajax();
        }
        // } else {
        return 'This is api page.';
        // }
    }

    public function _get()
    {
        $table = input('get.table');
        if ($table) {
            $list = model($table);

            if ($list) {
                $list->select();
                response($list);
            }
        } else {
            return 'This is api page.';
        }
    }

    public function _post()
    {
        $table = input('get.table');
        $list  = db($table)->find(input('get.id'));
        response($list);
    }

    public function _delete()
    {
        response('delete');
    }

    public function _ajax()
    {
        response('ajax');
    }

}
