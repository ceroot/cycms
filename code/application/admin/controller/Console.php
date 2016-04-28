<?php
/**
 * 
 * 
 * @authors SpringYang
 * @email   ceroot@163.com
 * @QQ      525566309
 * @date    2016-04-21 14:02:52
 * @site    http://www.benweng.com
 */
namespace app\admin\controller;
use app\admin\controller\Base;
// use think\Controller;


class Console extends Base {
    
    public function index(){
	    // // return 'main';
	    // $view = new \think\View();
     //    return $view->fetch('index');

	    return $this->fetch();
	}

	public function index2(){
	    return $this->fetch();
	}

	public function index3(){
		return $this->fetch();
	}
	public function index4(){
	    return $this->fetch();
	}

	public function index5(){
		return $this->fetch();
	}
	public function index6(){
	    return $this->fetch();
	}

	public function index7(){
		return $this->fetch();
	}

	public function index8(){
		// return view('admin@index/index');
	}
}

