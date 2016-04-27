<?php
namespace app\admin\controller;
use app\admin\controller\Base;


class authRule extends Base
{
	public $model;

	/**
	 * [_initialize 初始化]
	 * @return [type] [description]
	 */
	public function _initialize(){
        parent::_initialize();
		$this->model  = model('authRule');

	}

	// 规则管理首页
	public function index(){

	    return $this->fetch();
	}


    // 规则列表
    public function list(){

    	return $this->fetch();
    }

    
}
