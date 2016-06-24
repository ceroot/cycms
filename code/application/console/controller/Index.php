<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 *
 * @filename  Index.php[控制台首页]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-21 14:02:52
 * @site      http://www.benweng.com
 */
namespace app\console\controller;

use app\console\controller\Base;

class Index extends Base
{
    public function index()
    {

        return $this->fetch();
    }

    public function index2()
    {
        return $this->fetch();
    }

    public function index3()
    {
        return $this->fetch();
    }
    public function index4()
    {
        return $this->fetch();
    }

    public function index5()
    {
        return $this->fetch();
    }
    public function index6()
    {
        return $this->fetch();
    }

    public function index7()
    {
        return $this->fetch();
    }

    public function index8()
    {
        // return view('admin@index/index');
    }

    public function copyright()
    {
        $info = [
            '系统版本'       => config('cms_version'),
            //'操作系统'    => $this->get_os(),
            '运行环境'       => $_SERVER['SERVER_SOFTWARE'],
            'PHP版本'      => PHP_VERSION,
            'PHP运行方式'    => php_sapi_name(),
            '数据库'        => config('type'), // . ' ' . $this->get_mysql_version(),
            'ThinkPHP版本' => THINK_VERSION,
            '最大上传附件'     => ini_get('upload_max_filesize'),
        ];
        // dump($info);die;
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     * [get_mysql_version 数据库版本]
     * @return [type] [description]
     */
    public function get_mysql_version()
    {
        // $user      = db();
        // $pdo       = new PDO("mysql:host=127.0.0.1;dbname=think5", "root", "root");
        $con       = mysql_connect('127.0.0.1', 'root', 'root');
        $mysqlinfo = mysql_get_server_info($con);
        // $res = mysql_query("select VERSION()");
        // $row = mysql_fetch_row($res);
        return $mysqlinfo;
    }

    public function setcollapsed()
    {
        $collapsed = input('post.collapsed');
        if ($collapsed == 1 || $collapsed == 0) {
            if ($collapsed == '1') {
                session('collapsed', $collapsed);
            } else {
                session('collapsed', null);
            }
        }
    }

    public function getcollapsed()
    {
        if (session('?collapsed')) {
            return session('collapsed');
        } else {
            return 0;
        }
    }

    public function setsmscscreen()
    {
        $smscreen = input('post.screen');
        if ($smscreen == 1 || $smscreen == 0) {
            if ($smscreen == '1') {
                session('screen', $smscreen);
            } else {
                session('screen', null);
            }
        }
    }

    public function getsmscscreen()
    {
        if (session('?screen')) {
            return session('screen');
        } else {
            return 0;
        }
    }

}
