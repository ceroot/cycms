<?php
/**
 * 
 * 管理员表模型
 * @authors SpringYang
 * @email   ceroot@163.com
 * @date    2016-03-29 17:41:58
 * @site    http://www.benweng.com
 */

namespace app\common\model;
use think\Model;

class Manager extends Model
{
	public $error;

	public function getone(){
        $data = $this->find(UID);
        return $data;
	}

	static public function cc(){
		return 123999;
		$this->error;
	}

	/**
	 * [validate_login 验证登录]
	 * @return [type] [description]
	 */
    public function validate_login()
	{
		/******接收数据******/
		$username = I('post.username'); //用户名
		$password = I('post.password'); //密码
    	$code     = I('post.verify');   //验证码

    	// return $username;

    	$this->error  = 456;
    	return false;


		/******普通验证******/
      
		// 用户名不为空
		if(!$username||$username=='请输入用户名')
		{
			$this->error = '请输入用户名';
			return false;
		}
	  
		// 密码不为空
		if(!$password)
		{
			$this->error = '请输入密码';
			return false;
		}

		$error_num	= session('error_num');
		if(!isset($error_num))
		{
			session('error_num',0);
		}
	    
		// 验证码验不为空
		if($error_num>3 && !$code)
		{
			$this->error = '请输入验证码';
			return false;
		}

		$verify = new \third\Verify();
		// 验证码是否相等
		if($error_num>3 && !$verify->check($code))
		{
			$this->error = '验证码输入错误';
			return false;
		}
		
		/******数据库验证******/
		// $user   = $this->where(array('username'=>$username))->find();
		$user = Manager::get(function($query){
		    $query->where('username','ceroot@163.co');
		});

		// 用户不存在
		return $user;
		if(!$user)
		{
			return $this->error = '用户不存在';
			// $_SESSION['error_num']++;
			session('error_num',$error_num+1);
			return false;
		}
		// 密码不对
		if($user['password'] != md5($username.$password))
		{
			$this->error = '用户名或密码错误';
			// $_SESSION['error_num']++;
			session('error_num',$error_num+1);
			return false;
		}

		if($user['status'])
		{
			$this->error = '用户锁定中，请联系管理员';
			return false;
		}

		$auto = I('post.auto');
		if($auto)
		{
			setcookie(session_name(),session_id(),time()+60*60*24*14,'/');
		}
		else
		{
			setcookie(session_name(),session_id(),0,'/');
		}

		return $user;
	}


	/**
	 * [set_session set_session]
	 * @param [type] $user [description]
	 */
	public function set_session($user)
	{
		session('userid',$user['uid']);
		session('username',$user['username']);
		session('nickname',$user['nickname']);
	}

	
	/**
	 * [update_login 更新登录信息]
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function update_login($user)
	{
		// 更新登录信息
		$data	= array(
			'uid'	=> $user['uid'],
			'times'	=> $user['times']+1,
			'login_time'	=> time(),
			'login_ip'		=> ip2int()
		);	
		$this->save($data);
	}


}
