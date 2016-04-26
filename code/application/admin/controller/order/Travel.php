<?php
namespace app\admin\controller\order;
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

class Travel extends Base {
    
    public function index(){
	    // // return 'main';
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

	public function index4(){
		return view('admin@index/index');
	}
}

