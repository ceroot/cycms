<?php
use think\Db;
use third\Verify;

function yctest(){
	// $dd  = new \third\Yctest();
	return Yctest::sayHello();
}

/**
 * 验证码验证
 * @param  string    $$code    传入的验证码
 * @return booln
 */
function verifyCheck($code){
    $verify = new \third\Verify();
    if($verify->check($code)){
        return true;
    }else{
        return false;
    }
}

/**
 * 生成树形结构数组
 * @param array     $cate   传入数组
 * @param string    $pid    传入父id
 * @return array    $arr    返还数组
 */
function getCateTreeArr($cate,$pid){
    $arr = array();
    foreach($cate as $k => $v){
        if($v['mid']==$pid){
            $child = getCateTreeArr($cate,$v['id']);
            if($child){
                $v['items'] = $child;
            }
            $arr[] = $v;
        }
    }
    return $arr;
}

/**
 * 传递一个子级返回父级id 例如:首页>>服装>>女装>>裙子
 * @param array     $cate   传入数组
 * @param string    $pid    传入id
 * @return array    $arr    返还数组
 */
function getParents($cate,$id){
    $arr=array();
    foreach($cate as $v){
        if($v['id']==$id){
            $arr[]=$v;
            $arr=array_merge(getParents($cate,$v['mid']),$arr);
        }
    }
    return $arr;
}

/**
 * 传递一个父级ID返回所有子级分类
 * @param array     $cate   传入数组
 * @param string    $pid    传入id
 * @return array    $arr    返还数组
 */
function getChiIds($cate,$pid,$str=0){
    $arr=array();
    static $strarr = array();
    foreach ($cate as $v){
        if($v['mid']==$pid){
            $arr[]= $v;
            $strarr[] = $v['id'];
            $arr=array_merge($arr,getChiIds($cate,$v['id']));
        }
    }
    return $str == 1 ? $strarr : $arr;
}

/**
 * 传递一个子级返回父级id 例如:首页>>服装>>女装>>裙子
 * @param array     $cate   传入数组
 * @param string    $pid    传入id
 * @return array    $arr    返还数组
 */
function getCateByPid($cate,$pid=0){
    $arr = array();
    foreach($cate as $v){
        if($v['mid']==$pid){
            // $arr[] = array('id'=>$v['id'],'name'=>$v['name']);
            $arr[] = $v;
        }
    }
    return $arr;
}

/**
 * checkAuth 权限验证
 * @param $authName
 * @param $uid
 * @return booln
 */
function authCheck($authName,$uid)
{
	$auth = new \auth\Auth();
	if($auth->check(strtolower($authName),$uid))
	{
		return true;
	}
	else
	{
		return false;
	}
}

/**
 * [ip2int ip地址转换为int]
 * @return	[int]
 * @author  ceroot@163.com
 */
function ip2int($ip=''){
	if($ip==''){
       $ip  = get_client_ip();
	}
	return sprintf("%u",ip2long($ip));
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装） 
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author SpringYang <ceroot@163.com>
 */
function time_format($time = NULL,$format='Y-m-d H:i'){
    $time = $time === NULL ? NOW_TIME : intval($time);
    return date($format, $time);
}

/**
 * 取得管理员昵称
 * @param int $uid
 * @author SpringYang <ceroot@163.com>
 */
function get_nickname($uid = NULL){
	if(!($uid && is_numeric($uid))){ //获取当前登录用户名
	    return session('username');
    }
	// $uid  = session('userid');
    return Db::name('manager')->getFieldByUid($uid,'nickname');
}

/**
 * 取得管理员真实姓名
 * @param int $uid
 * @author SpringYang <ceroot@163.com>
 */
function get_realname($uid = NULL){
	if(!($uid && is_numeric($uid))){ //获取当前登录用户名
	    return '';
    }
	// $uid  = session('userid');
    return Db::name('manager')->getFieldByUid($uid,'realname');
}

/**
 * 记录行为日志，并执行该行为的规则
 * @param string $action 行为标识
 * @param string $model 触发行为的模型名
 * @param int $record_id 触发行为的记录id
 * @param int $user_id 执行行为的用户id
 * @return boolean
 * @author
 */
function action_log($action = null, $model = null, $record_id = null, $user_id = null){

    // 参数检查
    if(empty($action) || empty($model) || empty($record_id)){
        return '参数不能为空';
    }

    // 查询行为,判断是否执行
    $action_info = Db::name('managerAction')->getByName($action);
    if($action_info['status'] != 1){
        return '该行为被禁用或删除';
    }

    // 取得日志规则
    $action_log  = $action_info['log'];

    // 插入行为日志
    $data['action_id']      =   $action_info['id'];
    $data['user_id']        =   $user_id;
    $data['action_ip']      =   ip2int();
    $data['model']          =   $model;
    $data['record_id']      =   $record_id;
    $data['create_time']    =   NOW_TIME;

    // 解析日志规则,生成日志备注
    if(!empty($action_log)){
        if(preg_match_all('/\[(\S+?)\]/', $action_log, $match)){
            $log['user']    =   $user_id;
            $log['record']  =   $record_id;
            $log['model']   =   $model;
            $log['time']    =   NOW_TIME;
            $log['data']    =   array('user'=>$user_id,'model'=>$model,'record'=>$record_id,'time'=>NOW_TIME);

            foreach ($match[1] as $value){
                $param = explode('|', $value);
                if(isset($param[1])){
                    $replace[] = call_user_func($param[1],$log[$param[0]]);
                }else{
                    $replace[] = $log[$param[0]];
                }
            }

            $data['remark'] =   str_replace($match[0], $replace, $action_log);
        }else{
            $data['remark'] =   $action_log;
        }
    }else{
        // 未定义日志规则，记录操作url
        $data['remark']     =   '操作url：'.$_SERVER['REQUEST_URI'];
    }

    Db::name('managerActionLog')->insert($data);
}