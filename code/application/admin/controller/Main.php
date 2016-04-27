<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Controller;

class Main extends controller
{


	public function index(){
	    // return 'main';
	    // $view = new \think\View();
     //    return $view->fetch('index');

	    return $this->fetch();
	}

	public function index2(){
	    // return 'main';

	    return $this->fetch();
	}

	public function index3(){
		return $this->fetch();
	}


	
}