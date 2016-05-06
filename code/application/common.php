<?php
use third\Verify;
function yctest()
{
    // $dd  = new \third\Yctest();
    return Yctest::sayHello();
}
/**
 * 验证码验证
 * @param  string    $$code    传入的验证码
 * @return booln
 */
function verifyCheck($code)
{
    $verify = new \third\Verify();
    if ($verify->check($code)) {
        return true;
    } else {
        return false;
    }
}
/**
 * 生成树形结构数组
 * @param array     $cate   传入数组
 * @param string    $pid    传入父id
 * @return array    $arr    返还数组
 */
function getCateTreeArr($cate, $pid)
{
    $arr = array();
    foreach ($cate as $k => $v) {
        if ($v['mid'] == $pid) {
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
 * @param array     $cate   传入数组
 * @param string    $pid    传入id
 * @return array    $arr    返还数组
 */
function getParents($cate, $id)
{
    $arr = array();
    foreach ($cate as $v) {
        if ($v['id'] == $id) {
            $arr[] = $v;
            $arr   = array_merge(getParents($cate, $v['mid']), $arr);
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
function getChiIds($cate, $pid, $str = 0)
{
    $arr           = array();
    static $strarr = array();
    foreach ($cate as $v) {
        if ($v['mid'] == $pid) {
            $arr[]    = $v;
            $strarr[] = $v['id'];
            $arr      = array_merge($arr, getChiIds($cate, $v['id']));
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
function getCateByPid($cate, $pid = 0)
{
    $arr = array();
    foreach ($cate as $v) {
        if ($v['mid'] == $pid) {
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
function authCheck($authName, $uid)
{
    $auth = new \auth\Auth();
    if ($auth->check(strtolower($authName), $uid)) {
        return true;
    } else {
        return false;
    }
}
/**
 * [ip2int ip地址转换为int]
 * @return  [int]
 * @author  ceroot@163.com
 */
function ip2int($ip = '')
{
    if ($ip == '') {
        $ip = get_client_ip();
    }
    return sprintf("%u", ip2long($ip));
}
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0, $adv = false)
{
    $type      = $type ? 1 : 0;
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
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author SpringYang <ceroot@163.com>
 */
function time_format($time = null, $format = 'Y-m-d H:i')
{
    $time = $time === null ? NOW_TIME : intval($time);
    return date($format, $time);
}
/**
 * 取得管理员昵称
 * @param int $uid
 * @author SpringYang <ceroot@163.com>
 */
function get_nickname($uid = null)
{
    if (!($uid && is_numeric($uid))) {
        //获取当前登录用户名
        return session('username');
    }
    // $uid  = session('userid');
    return db('manager')->getFieldByUid($uid, 'nickname');
}
/**
 * 取得管理员真实姓名
 * @param int $uid
 * @author SpringYang <ceroot@163.com>
 */
function get_realname($uid = null)
{
    if (!($uid && is_numeric($uid))) {
        //获取当前登录用户名
        return '';
    }
    // $uid  = session('userid');
    return db('manager')->getFieldByUid($uid, 'realname');
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
function action_log($action = null, $model = null, $record_id = null, $user_id = null)
{
    // 参数检查
    if (empty($action) || empty($model) || empty($record_id)) {
        return '参数不能为空';
    }
    // 查询行为,判断是否执行
    $action_info = db('action')->getByName($action);
    if ($action_info['status'] != 1) {
        return '该行为被禁用或删除';
    }
    // 取得日志规则
    $action_log = $action_info['log'];
    // 插入行为日志
    $data['action_id']   = $action_info['id'];
    $data['user_id']     = $user_id;
    $data['action_ip']   = ip2int();
    $data['model']       = $model;
    $data['record_id']   = $record_id;
    $data['create_time'] = NOW_TIME;
    // 解析日志规则,生成日志备注
    if (!empty($action_log)) {
        if (preg_match_all('/\[(\S+?)\]/', $action_log, $match)) {
            $log['user']   = $user_id;
            $log['record'] = $record_id;
            $log['model']  = $model;
            $log['time']   = NOW_TIME;
            $log['data']   = array('user' => $user_id, 'model' => $model, 'record' => $record_id, 'time' => NOW_TIME);
            foreach ($match[1] as $value) {
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
 * @param string $action 行为id或者name
 * @param int $self 替换规则里的变量为执行用户的id
 * @return boolean|array: false解析出错 ， 成功返回规则数组
 * @author huajie <banhuajie@163.com>
 */
function parse_action($action = null, $self)
{
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
    $rules  = $info['rule'];
    $rules  = str_replace('{$self}', $self, $rules);
    $rules  = explode(';', $rules);
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
 * @param array $rules 解析后的规则数组
 * @param int $action_id 行为id
 * @param array $user_id 执行的用户id
 * @return boolean false 失败 ， true 成功
 * @author huajie <banhuajie@163.com>
 */
function execute_action($rules = false, $action_id = null, $user_id = null)
{
    if (!$rules || empty($action_id) || empty($user_id)) {
        return false;
    }

    $return = true;
    foreach ($rules as $rule) {

        //检查执行周期
        $map                = array('action_id' => $action_id, 'user_id' => $user_id);
        $map['create_time'] = array('gt', NOW_TIME - intval($rule['cycle']) * 3600);
        $exec_count         = db('ActionLog')->where($map)->count();
        if ($exec_count > $rule['max']) {
            continue;
        }

        //执行数据库操作
        $Model = db(ucfirst($rule['table']));
        $field = $rule['field'];
        $res   = $Model->where($rule['condition'])->setField($field, array('exp', $rule['rule']));

        if (!$res) {
            $return = false;
        }
    }
    return $return;
}

/**
 * 取得行为id并返回
 * @param string $action 行为标识
 * @return $id | boolean
 * @author
 */
function getRecordId($action)
{
    // $data = db('action')->where('name'=>$action)->find();
    $id = db('action')->getFieldByName($action, 'id');
    if ($id) {
        return $id;
    } else {
        return false;
    }
}

/**
 * 将驼峰式命名转换为下划线命名
 * @param string $str 字符串
 * @return string
 * @author
 */
function toUnderline($str)
{
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
 * @param string $str 字符串
 * @return string
 * @author
 */
function toCamel($str)
{
    $str = ucwords(str_replace('_', ' ', $str));
    $str = str_replace(' ', '', lcfirst($str));
    return $str;
}
