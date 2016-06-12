<?php
/**
 * checkAuth 权限验证
 * @param  string    $authName  [传入验证标识]
 * @param  string    $uid       [用户id]
 * @return boolean              [返回布尔值]
 * @author SpringYang <ceroot@163.com>
 */
function authCheck($authName, $uid) {
	$auth = new \auth\Auth();
	if ($auth->check(strtolower($authName), $uid)) {
		return true;
	} else {
		return false;
	}
}

// 函数make_dir()建立目录。判断要保存的图片文件目录是否存在，如果不存在则创建目录，并且将目录设置为可写权限。
/*
 * 参数:
@string: $path 目录路径;
 */
function make_dir($path) {
	if (!file_exists($path)) {
		// 如果文件夹不存在则建立
		make_dir(dirname($path)); // 多层创建
		mkdir($path, 0755); // 给文件夹设置权
		@chmod($path, 0755);
	}
	return true;
}

/**
 * 生成树形结构数组
 * @param  array   $cate  传入数组
 * @param  string  $pid   传入父id
 * @return array   $arr   返回数组
 */
function getCateTreeArr($cate, $pid) {
	$arr = array();
	foreach ($cate as $k => $v) {
		if ($v['pid'] == $pid) {
			$child = getCateTreeArr($cate, $v['id']);
			if ($child) {
				$v['items'] = $child;
			}
			$arr[] = $v;
		}
	}
	return $arr;
}
/**
 * 传递一个子级返回父级id 例如:首页>>服装>>女装>>裙子
 * @param array   $cate  传入数组
 * @param string  $pid   传入id
 * @return array  $arr   返回数组
 */
function getParents($cate, $id) {
	$arr = array();
	foreach ($cate as $v) {
		if ($v['id'] == $id) {
			$arr[] = $v;
			$arr = array_merge(getParents($cate, $v['pid']), $arr);
		}
	}
	return $arr;
}
/**
 * 传递一个父级ID返回所有子级分类
 * @param array     $cate   传入数组
 * @param string    $pid    传入id
 * @return array    $arr    返回数组
 */
function getChiIds($cate, $pid, $str = 0) {
	$arr = array();
	static $strarr = array();
	foreach ($cate as $v) {
		if ($v['pid'] == $pid) {
			$arr[] = $v;
			$strarr[] = $v['id'];
			$arr = array_merge($arr, getChiIds($cate, $v['id']));
		}
	}
	return $str == 1 ? $strarr : $arr;
}
/**
 * 传递一个子级返回父级id 例如:首页>>服装>>女装>>裙子
 * @param array     $cate   传入数组
 * @param string    $pid    传入id
 * @return array    $arr    返回数组
 */
function getCateByPid($cate, $pid = 0) {
	$arr = array();
	foreach ($cate as $v) {
		if ($v['pid'] == $pid) {
			// $arr[] = array('id'=>$v['id'],'name'=>$v['name']);
			$arr[] = $v;
		}
	}
	return $arr;
}

/**
 * [ip2int ip地址转换为int]
 * @param   string  $ip  [ip地址]
 * @return  int          [返回整形数字]
 * @author  SpringYang <ceroot@163.com>
 */
function ip2int($ip = '') {
	if ($ip == '') {
		$ip = get_client_ip();
	}
	return sprintf("%u", ip2long($ip));
}
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv  是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0, $adv = false) {
	$type = $type ? 1 : 0;
	static $ip = null;
	if ($ip !== null) {
		return $ip[$type];
	}

	if ($adv) {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$pos = array_search('unknown', $arr);
			if (false !== $pos) {
				unset($arr[$pos]);
			}

			$ip = trim($arr[0]);
		} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	} elseif (isset($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	// IP地址合法验证
	$long = sprintf("%u", ip2long($ip));
	$ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
	return $ip[$type];
}
/**
 * 时间戳格式化
 * @param  int     $time   [时间]
 * @param  string  $format [时间格式]
 * @return string          [返回时间显示格式]
 * @author SpringYang <ceroot@163.com>
 */
function time_format($time = null, $format = 'Y-m-d H:i:s') {
	if (empty($time)) {
		$time = time();
	}
	return date($format, intval($time));
}
/**
 * 取得管理员昵称
 * @param  int    $uid  [用户id]
 * @return string       [返回字符]
 * @author SpringYang <ceroot@163.com>
 */
function get_nickname($uid = null) {
	if (!($uid && is_numeric($uid))) {
		return session('username');
	}
	return db('manager')->getFieldById($uid, 'nickname');
}

/**
 * 取得管理员真实姓名
 * @param  int    $uid  [用户id]
 * @return string       [返回字符]
 * @author SpringYang <ceroot@163.com>
 */
function get_realname($uid = null) {
	if (!($uid && is_numeric($uid))) {
		return '';
	}
	return db('manager')->getFieldById($uid, 'realname');
}

/**
 * 获得禁用和启用状态文字
 * @param  string  $table_id [表名和当前id]
 * @return string            [返回启用或者禁用]
 * @author SpringYang <ceroot@163.com>
 */
function status_text($table_id) {
	$arr = explode('|', $table_id);
	$value = db($arr[0])->getFieldById($arr[1], 'status');
	return ($value == 1) ? '启用' : '禁用';
}

/**
 * 获特殊情况文字
 * @param string $type [从session取得的文字]
 * @param string       [返回字符]
 * @author SpringYang <ceroot@163.com>
 */
function get_log_session_text($type) {
	session('log_text', null);
	return $type;
}

/**
 * 记录行为日志，并执行该行为的规则
 * @param  string   $action     [行为标识]
 * @param  string   $model      [触发行为的模型名]
 * @param  int      $record_id  [触发行为的记录id]
 * @param  int      $user_id    [执行行为的用户id]
 * @return boolean
 * @author SpringYang <ceroot@163.com>
 */
function action_log($record_id = null, $action = null, $model = null, $user_id = UID) {
	// 参数检查
	if (empty($record_id)) {
		return '参数不能为空';
	}

	if (empty($model)) {
		$model = request()->controller();
	}

	if (empty($action)) {
		$action = strtolower(toCamel(request()->controller())) . '_' . request()->action();
	}

	// 查询行为,判断是否执行
	$action_info = db('action')->getByName($action);
	if ($action_info['status'] != 1) {
		return '该行为被禁用或删除';
	}
	// 取得日志规则
	$action_log = $action_info['log'];

	// 解析日志规则,生成日志备注
	if (!empty($action_log)) {
		if (preg_match_all('/\[(\S+?)\]/', $action_log, $match)) {
			$log['user'] = $user_id;
			$log['record'] = $record_id;
			$log['model'] = $model;
			$log['time'] = time();
			$log['table_id'] = $model . '|' . $record_id;
			$log['type'] = session('log_text');
			$log['data'] = array('user' => $user_id, 'model' => $model, 'record' => $record_id, 'time' => time());

			foreach ($match[1] as $key => $value) {
				//dump($value);
				$param = explode('|', $value);
				if (isset($param[1])) {
					$replace[] = call_user_func($param[1], $log[$param[0]]);
				} else {
					$replace[] = $log[$param[0]];
				}
			}

			$data['remark'] = str_replace($match[0], $replace, $action_log);
		} else {
			$data['remark'] = $action_log;
		}
	} else {
		// 未定义日志规则，记录操作url
		$data['remark'] = '操作url：' . $_SERVER['REQUEST_URI'];
	}

	// 插入行为日志
	$data['action_id'] = $action_info['id'];
	$data['user_id'] = $user_id;
	$data['action_ip'] = ip2int();
	$data['model'] = $model;
	$data['record_id'] = $record_id;
	$data['create_time'] = time();

	db('ActionLog')->insert($data);
}

/**
 * 解析行为规则
 * 规则定义  table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
 * 规则字段解释：table->要操作的数据表，不需要加表前缀；
 *              field->要操作的字段；
 *              condition->操作的条件，目前支持字符串，默认变量{$self}为执行行为的用户
 *              rule->对字段进行的具体操作，目前支持四则混合运算，如：1+score*2/2-3
 *              cycle->执行周期，单位（小时），表示$cycle小时内最多执行$max次
 *              max->单个周期内的最大执行次数（$cycle和$max必须同时定义，否则无效）
 * 单个行为后可加 ； 连接其他规则
 * @param string $action [行为id或者name]
 * @param int    $self   [替换规则里的变量为执行用户的id]
 * @return boolean|array: false解析出错 ， 成功返回规则数组
 * @author huajie <banhuajie@163.com>
 */
function parse_action($action = null, $self) {
	if (empty($action)) {
		return false;
	}

	//参数支持id或者name
	if (is_numeric($action)) {
		$map = array('id' => $action);
	} else {
		$map = array('name' => $action);
	}

	//查询行为信息
	$info = db('Action')->where($map)->find();
	if (!$info || $info['status'] != 1) {
		return false;
	}

	//解析规则:table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
	$rules = $info['rule'];
	$rules = str_replace('{$self}', $self, $rules);
	$rules = explode(';', $rules);
	$return = array();
	foreach ($rules as $key => &$rule) {
		$rule = explode('|', $rule);
		foreach ($rule as $k => $fields) {
			$field = empty($fields) ? array() : explode(':', $fields);
			if (!empty($field)) {
				$return[$key][$field[0]] = $field[1];
			}
		}
		//cycle(检查周期)和max(周期内最大执行次数)必须同时存在，否则去掉这两个条件
		if (!array_key_exists('cycle', $return[$key]) || !array_key_exists('max', $return[$key])) {
			unset($return[$key]['cycle'], $return[$key]['max']);
		}
	}

	return $return;
}

/**
 * 执行行为
 * @param  array   $rules     [解析后的规则数组]
 * @param  int     $action_id [行为id]
 * @param  array   $user_id   [执行的用户id]
 * @return boolean            [false 失败 ， true 成功]
 * @author huajie <banhuajie@163.com>
 */
function execute_action($rules = false, $action_id = null, $user_id = null) {
	if (!$rules || empty($action_id) || empty($user_id)) {
		return false;
	}

	$return = true;
	foreach ($rules as $rule) {

		//检查执行周期
		$map = array('action_id' => $action_id, 'user_id' => $user_id);
		$map['create_time'] = array('gt', NOW_TIME - intval($rule['cycle']) * 3600);
		$exec_count = db('ActionLog')->where($map)->count();
		if ($exec_count > $rule['max']) {
			continue;
		}

		//执行数据库操作
		$Model = db(ucfirst($rule['table']));
		$field = $rule['field'];
		$res = $Model->where($rule['condition'])->setField($field, array('exp', $rule['rule']));

		if (!$res) {
			$return = false;
		}
	}
	return $return;
}

/**
 * 将驼峰式命名转换为下划线命名
 * @param  string $str [字符串]
 * @return string      [返回字符]
 * @author SpringYang <ceroot@163.com>
 */
function toUnderline($str) {
	$temp_array = array();
	for ($i = 0; $i < strlen($str); $i++) {
		$ascii_code = ord($str[$i]);
		if ($ascii_code >= 65 && $ascii_code <= 90) {
			if ($i == 0) {
				$temp_array[] = chr($ascii_code + 32);
			} else {
				$temp_array[] = '_' . chr($ascii_code + 32);
			}
		} else {
			$temp_array[] = $str[$i];
		}
	}
	return implode('', $temp_array);
}

/**
 * 将下划线命名转换为驼峰式命名
 * @param  string $str [字符串]
 * @return string      [返回字符]
 * @author SpringYang <ceroot@163.com>
 */
function toCamel($str) {
	$str = ucwords(str_replace('_', ' ', $str));
	$str = str_replace(' ', '', lcfirst($str));
	return $str;
}

/**
 * 退出 url
 * @return     string  [url地址]
 * @author SpringYang <ceroot@163.com>
 */
function logouturl() {
	// $loginout = url('Login/loginout') . '?backurl=' . getbackurl();
	$loginout = url('console/login/logout?time=' . date('YmdHis') . getrandom(128)) . '?backurl=' . getbackurl();
	return $loginout;
}

/**
 * getcurrenturl  取得当前url并转换成asc
 * 退出 url
 * @return     string  [url地址]
 * @author SpringYang <ceroot@163.com>
 */
function getbackurl() {
	$backurl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$backurl = str_replace('/', '%2F', $backurl);
	$backurl = str_replace(':', '%3A', $backurl);
	return $backurl;
}

// function getnum($length = 32)
// {
//     $time = substr(implode(null, array_map('ord', str_split(md5(uniqid()), 1))), 0, $length);

//     return $time;
// }

/**
 * 随机数函数
 * @param  string    $length     [长度]
 * @param  int       $numeric    [类型 0为数字，1为全部，2为大写，3为小写，4为数字加小写，5为uniqid()]
 * @return string    $hash       [返回数字]
 * @author SpringYang <ceroot@163.com>
 */
function getrandom($length = 6, $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double) microtime() * 1000000);
	if ($length > 10 && $numeric == 0) {
		$numeric = 5;
	}

	$hash = '';
	switch ($numeric) {
	case 0:
		$hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
		break;
	case 1:
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for ($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		break;
	case 2:
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
		$max = strlen($chars) - 1;
		for ($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		break;
	case 3:
		$chars = 'abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for ($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		break;
	case 4:
		$chars = '23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for ($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	case 5:
		$uniqid = implode(null, array_map('ord', str_split(md5(uniqid()), 1)));
		$max = strlen($uniqid) - 1;
		for ($i = 0; $i < $length; $i++) {
			$temp = $uniqid[mt_rand(0, $max)];
			// 去掉第一个为 0 的情况
			if ($i == 0 && $temp == 0) {
				$temp = sprintf('%0' . 1 . 'd', mt_rand(0, pow(10, 1) - 1));
			}
			$hash .= $temp;
		}
		break;
	default:
		$hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
		// 代码
	}
	return $hash;
}

/**
 * 取得关键词，分词
 * @param  string    $str        [需要分词的字符串]
 * @param  string    $lenght     [分文词长度，默认为5个]
 * @param  string    $separator  [分隔符，默认为英文的逗号]
 * @return string    $str        [返回分词]
 * @author SpringYang <ceroot@163.com>
 */
function get_keywords($str, $lenght = 10, $separator = ',') {
	Vendor('scws.pscws4');
	$pscws = new \PSCWS4();
	$pscws->set_dict(VENDOR_PATH . 'scws/lib/dict.utf8.xdb');
	$pscws->set_rule(VENDOR_PATH . 'scws/lib/rules.utf8.ini');
	$pscws->set_ignore(true);
	$pscws->send_text($str);
	$words = $pscws->get_tops($lenght);
	$pscws->close();

	$end = end($words);
	$tags = '';
	foreach ($words as $val) {
		if ($val != $end) {
			$tags .= $val['word'] . $separator;
		} else {
			$tags .= $val['word'];
		}
	}
	return $tags;
}

/**
 * 修改文章时删除原来数据库里被修改去的图片
 * @param  string    $dataForm    [表单提交过来的数据]
 * @param  string    $dataSql     [数据库里的数据]
 * @return string    $str            [返回分词]
 * @author SpringYang <ceroot@163.com>
 */
function del_images($dataForm, $dataSql) {

	// 取得图片正则
	$patternImage = '<img.*?src="(.*?)">';

	// 匹配表单数据并取得数据
	if (preg_match_all($patternImage, $dataForm, $matchesImageForm)) {
		$imgForm = $matchesImageForm[1];
		foreach ($imgForm as $key => $value) {
			// 去除静态资源里的图片
			if (stripos($value, 'statics/')) {
				unset($imgForm[$key]);
			}
		}
	}

	// 匹配数据库数据并取得数据
	if (preg_match_all($patternImage, $dataSql, $matchesImageSql)) {
		$imgSql = $matchesImageSql[1];
		foreach ($imgSql as $key => $value) {
			// 去除静态资源里的图片
			if (stripos($value, 'statics/')) {
				unset($imgSql[$key]);
			}
		}
	}

	// 如果表单数据不为空的话就去和数据库作对比并删除不需要进行删除的数据
	if (!empty($imgForm)) {
		foreach ($imgForm as $value) {
			if (!empty($imgSql)) {
				if (in_array($value, $imgSql)) {
					$k = array_search($value, $imgSql);
					unset($imgSql[$k]);
				}
			}
		}
	}

	// 如果进行处理后的数据不为空则执行删除操作
	if (!empty($imgSql)) {
		foreach ($imgSql as $value) {
			$arr = parse_url($value);
			$path = $arr['path'];
			if (file_exists('.' . $path)) {
				unlink('.' . $path);
			}
		}
	}

	// 匹配表单数据并取得数据
	$patternHref = '<a.*?href="(.*?)">';
	if (preg_match_all($patternHref, $dataForm, $matchesHrefForm)) {
		$hrefForm = $matchesHrefForm[1];
	}

	// 匹配数据库数据并取得数据
	if (preg_match_all($patternHref, $dataSql, $matchesHrefSql)) {
		$hrefSql = $matchesHrefSql[1];
	}

	// 如果表单数据不为空的话就去和数据库作对比并删除不需要进行删除的数据
	if (!empty($hrefForm)) {
		foreach ($hrefForm as $value) {
			if (!empty($hrefSql)) {
				if (in_array($value, $hrefSql)) {
					$k = array_search($value, $hrefSql);
					unset($hrefSql[$k]);
				}
			}
		}
	}

	// 如果进行处理后的数据不为空则执行删除操作
	if (!empty($hrefSql)) {
		foreach ($hrefSql as $value) {
			$arr = parse_url($value);
			$path = $arr['path'];
			if (is_file('.' . $path)) {
				unlink('.' . $path);
			}
		}
	}

}
