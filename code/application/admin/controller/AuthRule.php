<?php
/**
 *
 *
 * @authors SpringYang
 * @email   ceroot@163.com
 * @QQ      525566309
 * @date    2016-04-27 11:10:25
 * @site    http://www.benweng.com
 */
namespace app\admin\controller;

use app\admin\controller\Base;

class AuthRule extends Base
{
    public $model;

    /**
     * [_initialize 初始化]
     * @return [type] [description]
     */
    public function _initialize()
    {
        parent::_initialize();

        $data = $this->model->getAll();
        $this->assign('data', $data);

    }

    function list() {
        return $this->fetch();
    }

}
