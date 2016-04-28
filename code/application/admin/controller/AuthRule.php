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
use think\Db;


class AuthRule extends Base
{
	public $model;

	/**
	 * [_initialize 初始化]
	 * @return [type] [description]
	 */
	public function _initialize(){
        parent::_initialize();

		$data  = $this->model->get_all();
        $this->assign('data',$data);

	}

	public function list(){
		return $this->fetch();
	}

    
}
