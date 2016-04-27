<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Controller
{
	public $model;

	/**
	 * [_initialize 初始化]
	 * @return [type] [description]
	 */
	public function _initialize(){
		// echo 'init<br/>';
		// return '测试';
		$this->model  = model('manager');

	}

	public function yctest(){
		$ddd  = $this->model->cc();
		dump($this->model->getError());
		dump($ddd);
	}

	// 登录首页
	public function index(){

	    if(IS_POST){

            if($user  = $this->model->login_test()){
                // $redata  = $user;
                // 设置登录错误记录的session为0
                session('error_num',0);
                // 设置session
				$this->model->set_session($user);
				// 登录日志记录
				// $uid  = session('userid');
				// action_log('manager_login', 'manager', $uid, $uid);

                $redata  = array('status'=>1,'info'=>'登录成功','url'=>url('Console/index'),'error_num'=>0);
            }else{
                $error_num  = session('error_num');
                if($error_num>=3){
	                $redata  = array('status'=>0,'info'=>$this->model->getError(),'show_code'=>1,'error_num'=>$error_num);
	            }else{
	            	$redata  = array('status'=>0,'info'=>$this->model->getError(),'show_code'=>0,'error_num'=>$error_num);
	            }
            }

            return json_encode($redata);
	    }else{

		    // $view  = new \think\View(\think\Config::get());
		    // return $view->fetch();
		    return $this->fetch();
	    }
	}


    // 退出方法
    public function loginout(){

    	session('userid',null);
		session('username',null);
		session('nickname',null);
		
        return $this->success('注销成功', '/admin/index/index');
    }

    // 显示验证码
    public function showverify(){
    	$error_num	= session('error_num');
    	if($error_num>3){
            echo 1;
    	}else{
    		echo 0;
    	}
    }

    // 验证码方法
    public function verify(){
        // $dd  = new \third\Yctest();
        // $data = $dd->sayHello();
        // dump($data);
        // die;

        $config = array(
            'codeSet'=>'0123456789',
            'length'=>1,
            'fontSize'=>14,
            'fontttf'=>'5.ttf'
        );
        $Verify = new \third\Verify($config);
        $Verify->entry();
    }

}
