<?php
namespace app\admin\controller;
use app\admin\controller\Base;
// use think\Controller;
/**
 * 
 * 
 * @authors SpringYang
 * @email   ceroot@163.com
 * @date    2016-04-21 14:02:52
 * @site    http://www.benweng.com
 */

class Cache extends Base {
    
    public function index(){
	    return $this->fetch();
	}

	public function cache(){
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

