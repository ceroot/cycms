<?php
/**
 * 
 * 规则表模型
 * @authors SpringYang
 * @email   ceroot@163.com
 * @date    2016-03-31 14:49:22
 * @site    http://www.benweng.com
 */
namespace app\common\model;
use think\Model;
use think\Db;
use third\Data;

class AuthRule extends Model {
	protected $cache;

	public function __construct(){
		if(!cache('authrule')){
			$this->update_cache();
		}
		$this->cache = cache('authrule');	// 从缓存里取得规则数据
	}
	
	// 自动验证
	protected $_validate = array(
		array('name','require','请输入规则标识',1),
		array('name','check_name','规则标识已经存在',1,'callback'),
		array('title','require','请输入规则名称',1),
		array('title','check_title','规则名称已经存在',1,'callback'),
	);
	
	// 自动完成
	public $_auto = array(
		array('level','_level',3,'callback'),
		// 添加时间
        array('add_time','time',1,'function'),
		// 修改时间
        array('update_time','time',2,'function'),
	);

	public function get_all($isArray=0)
	{
		if($isArray)
			return Data::channelLevel($this->cache,0,'','id','mid');
		else
			return Data::tree($this->cache,'title','id','mid');
	}

	/**
	 * [update_cache 更新缓存]
	 * @return [type] [description]
	 */
	public function update_cache()
	{
		$data  = Db::name('authRule')->order(['sort'=>'asc','id'=>'asc'])->select();
		
		$temp = array();
		if($data)
		{
			foreach($data as $v)
			{
				$temp[$v['id']] = $v;
			}
		}
		// return $temp;
		cache('authrule',$temp);
	}
	
	/**
	 * [update_cache_auth_model 更新不需要权限验证的控制器、方法和不需要实例化模型缓存]
	 * @return [type]       [description]
	 */
	public function update_cache_auth_model()
	{
		// if(!cache('authrule')){
		// 	$this->update_cache();
		// }
		// $this->cache = cache('authrule');
		foreach($this->cache as $val)
		{
			$auth			= $val['auth'];				// 需要进行权限验证标记
			$controller		= $val['controller'];		// 是控制器标记
			$instantiation	= $val['instantiation'];	// 需要实例化模型标记
			
			// 取得不需要进行权限验证
			if($auth){
				$data['not_auth'][]	= $val['name'];
			}
			// 取得不需要实例化模型的控制器名称
			if($controller && !$instantiation)
			{
				$name	= explode('/',$val['name']);
				$name	= $name[0];
				$data['not_d_controller'][]	= $name;
			}
		}
		//return $data;//
		cache('auth_model',$data);
	}

	/**
	 * [check_name 验证规则标识是否存在]
	 * @param  [type] $con [description]
	 * @return [type]      [description]
	 */
	protected function check_name($con)
	{
		$id  = I('post.id');
		if($id)
			$where['id'] = array('neq',$id);
		$condition  = I('post.condition');
	
		$condition  = I('post.condition');
		$where['condition'] = $condition;
		$where['name'] = $con;
		$data = $this->where($where)->find();
		if($data)
			return false;
		return true;
	}

	/**
	 * [check_title 验证规则名称是否存在]
	 * @param  [type] $con [description]
	 * @return [type]      [description]
	 */
	protected function check_title($con)
	{
		$id  = I('post.id');
		if($id)
			$where['id'] = array('neq',$id);
		$where['title'] = $con;
		$data = $this->where($where)->find();
		if($data)
			return false;
		return true;
	}

	/**
	 * [_level 级别自动完成]
	 * @return [type] [description]
	 */
	protected function _level()
	{
		$pid = I('post.pid');
		if($pid==0)
			return 1;
		else
		{
			$data = $this->where(array('id'=>$pid))->find();
			return $data['level']+1;
		}
	}

	/**
	 * [get_one 查找一条记录]
	 * @return [type] [description]
	 */
	public function get_one($id)
	{
		return isset($this->cache[$id])?$this->cache[$id]:null;
	}

	/**
	 * [del 删除规则]
	 * @return [type] [description]
	 */
	public function del($id)
	{
		if($this->where(array('pid'=>$id))->count())
		{
			$this->error='请先删除子规则';
			return false;
		}
		$this->delete($id);
		$this->update_cache();
		return true;
	}
	/**
	 * [update_sort 更新排序]
	 * @param  [type] $cid   [description]
	 * @param  [type] $sort [description]
	 * @return [type]       [description]
	 */
	public function update_sort($ids,$sort)
	{

		foreach($ids as $k=>$v)
		{
			$this->save(array('sort'=>$sort[$k],'id'=>$v));
		}
		$this->update_cache();
		return true;
	}
	
	/**
	 * [admin_menu 生成后台菜单并缓存]
	 * @return [type] [description]
	 */
	public function admin_menu()
	{
		// 判断是不是超级管理员
		if(in_array(UID,config('auth_superadmin'))){
			$data	= $this->cache;
		}
		else
		{
			// 根据用户id来选择id所对应的用户拥有的显示数据
			// 满足条件
			// 1 权限管理所拥有的
			// 2 不需要进行权限验证的
			$auth_model	= cache('auth_model');	// 从缓存取得不需要进行权限验证的数据
			$data		= array();
			foreach($this->cache as $value)
			{
				if(authCheck($value['name'],UID) || in_array($value['name'],$auth_model['not_auth']))
				{
					$data[]	= $value;
				}
			}
		}

		// 可显示处理和其它处理
		$navdata	= array();
		// dump($data);
		foreach($data as $value)
		{
			// 激活当前处理
			$value['active']  = 0;

			$controller       = CONTROLLER_NAME;
			$action           = ACTION_NAME;
			// dump($controller.'/'.$action);

			// 取得当前方法id
			if(strtolower($value['name']) == strtolower($controller.'/'.$action)){
				$current_action_id   = $value['id'];
				$current_action_mid  = $value['mid'];
				// dump(1);
			}
// dump($current_action_id);
			$isnavshow	= $value['isnavshow'];	// 显示标记
			$status		= $value['status'];	// 正常使用标记
			
			if($isnavshow && $status){
				switch($value['name'])
				{
					case 'Manager/indexddd':		// 管理员管理
						$name	=  url($name,array('role'=>1));
						break;
					case 'UserComment/index':	// 评论管理
						$name	= url($name,array('verifystate'=>1));
						break;
					case '':
						$name	= '';
						break;
					default:
						$name	= url($value['name']);
				}
				$value['name']	= $name;
				$navdata[]		= $value;
			}	
		}

		// 处理当前高亮标记
        if(isset($current_action_id)){
        	// 子级返回父级数组
	        $active       = getParents($navdata,$current_action_id);

	        // 只取id组成数组
	        $activeidarr  = array();
	        foreach ($active as $value) {
	        	$activeidarr[]  = $value['id'];
	        }

	        // 高亮标识
	        $activedata  = array();
	        foreach ($navdata as $value) {
	        	if(in_array($value['id'], $activeidarr)){
	        		$value['active']  = 1;
	        	}

	        	$activedata[]  = $value;
	        }

	        // 子菜单
	        $second  = NULL;
			if(count($activeidarr)>2){
				foreach ($activedata as $value) {
					if($current_action_mid==$value['id']){
						$producttitle  = $value['title'];
						break;
					}
				}

				$second['title']  = $producttitle;
				$second['data']   = getCateByPid($activedata,$current_action_mid);
			}else{
				foreach ($activedata as $value) {
					// dump($current_action_id);
					// dump($value['id']);
					// echo 'id:'.$current_action_id;
					// echo '<br/>vid:'.$value['id'].'<br/>';
					if($current_action_id==$value['id']){
						$producttitle  = $value['title'];
						// dump(1);
						break;
					}
				}
				$second['title']  = $producttitle;
				$second['data']   = getChiIds($navdata,$current_action_id);
			}

			$treeArray['second']   = $second;
        }else{
        	dump('不存在');
        	return false;
        }
		
		$treeArray['menu']	   = getCateTreeArr($activedata,0);	// 生成树形结构
		
		// dump($treeArray);
		
		// 加上key标记
		// $menu		= array();
		// foreach ($treeArray as $value)
		// {
		// 	if($value['mid']==0)
		// 	{
		// 		$key		= 'admin'.$value['id'];
		// 		$menu[$key]	= $value;
		// 	}
		// }
		
		// 转换json
		// $menu	= json_encode($menu);



		return $treeArray;
	}


    // protected $beforeActionList = [
    //     'first',
    //     'second'=>  ['except'=>'hello'],
    //     'three' =>  ['only'=>'hello,data'],
    // ];

    
	// /**
	//  * [_after_insert 添加后置方法]
	//  * @param  [type] $data    [description]
	//  * @param  [type] $options [description]
	//  * @return [type]          [description]
	//  */
	// public function _after_insert($data,$options)
	// {
	// 	// 更新缓存
	// 	$this->update_cache();
	// }
	
	// /**
	//  * [_after_update 更新后置方法]
	//  * @param  [type] $data    [description]
	//  * @param  [type] $options [description]
	//  * @return [type]          [description]
	//  */
	// public function _after_update($data,$options)
	// {
	// 	// 更新缓存
	// 	$this->update_cache();
	// }

}