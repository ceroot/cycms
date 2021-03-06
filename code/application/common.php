<?php
/**
 * checkAuth 权限验证
 * @param  string    $authName  [传入验证标识]
 * @param  string    $uid       [用户id]
 * @return boolean              [返回布尔值]
 * @author SpringYang <ceroot@163.com>
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
 * 是否存在控制器
 * @param string $module 模块
 * @param string $controller 待判定控制器名
 * @return boolean
 */
function has_controller($module, $controller)
{
    $arr = get_files_controllers($module);

    if ((!empty($arr[$controller])) && $arr[$controller]['class_name'] == $controller) {
        return true;
    } else {
        return false;
    }
}

/**
 * 是否存在方法
 * @param string $module 模块
 * @param string $controller 待判定控制器名
 * @param string $action 待判定控制器名
 * @return number 方法结果，0不存在控制器 1存在控制器但是不存在方法 2存在控制和方法
 */
function has_action($module, $controller, $action)
{
    $arr = get_files_controllers($module);

    if ((!empty($arr[$controller])) && $arr[$controller]['class_name'] == $controller) {
        $method_name = array_map('array_shift', $arr[$controller]['method']);
        if (in_array($action, $method_name)) {
            return 2;
        } else {
            return 1;
        }
    } else {
        return 0;
    }
}

/**
 * [get_files_controllers 以文件读取控制器并缓存]
 * @param   string  $module   [模块名]
 * @return  array   $arr      [返回数组]
 * @author  SpringYang <ceroot@163.com>
 */
function get_files_controllers($module)
{
    $arr = cache('controllers_' . $module);
    if (empty($arr)) {
        $arr = \ReadClass::readDir(APP_PATH . $module . DS . 'controller');
        cache('controllers_' . $module, $arr);
    }
    return $arr;
}

/**
 * 获取当前request参数数组,去除值为空
 * @return array
 */
function get_query()
{
    $param = request()->except(['s']);
    $rst   = array();
    foreach ($param as $k => $v) {
        if (!empty($v)) {
            $rst[$k] = $v;
        }
    }
    return $rst;
}

// 函数make_dir()建立目录。判断要保存的图片文件目录是否存在，如果不存在则创建目录，并且将目录设置为可写权限。
/*
 * 参数:
@string: $path 目录路径;
 */
function make_dir($path)
{
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
function getCateTreeArr($cate, $pid)
{
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
function getParents($cate, $id)
{
    $arr = array();
    foreach ($cate as $v) {
        if ($v['id'] == $id) {
            $arr[] = $v;
            $arr   = array_merge(getParents($cate, $v['pid']), $arr);
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
function getChiIds($cate, $pid, $str = 0)
{
    $arr           = array();
    static $strarr = array();
    foreach ($cate as $v) {
        if ($v['pid'] == $pid) {
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
 * @return array    $arr    返回数组
 */
function getCateByPid($cate, $pid = 0)
{
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
 * [encrypt_password 密码加密]
 * @param   string  $password   [密码原值]
 * @param   string  $hash       [密码hash值]
 * @return  string              [返回加密后的值]
 * @author  SpringYang <ceroot@163.com>
 */
function encrypt_password($password, $hash)
{
    return md5(md5($password) . md5($hash));
}

/**
 * [ip2int ip地址转换为int]
 * @param   string  $ip  [ip地址]
 * @return  int          [返回整形数字]
 * @author  SpringYang <ceroot@163.com>
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
 * @param boolean $adv  是否进行高级模式获取（有可能被伪装）
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
 * @param  int     $time   [时间]
 * @param  string  $format [时间格式]
 * @return string          [返回时间显示格式]
 * @author SpringYang <ceroot@163.com>
 */
function time_format($time = null, $format = 'Y-m-d H:i:s')
{
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
function get_nickname($uid = null)
{
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
function get_realname($uid = null)
{
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
function status_text($table_id)
{
    $arr   = explode('|', $table_id);
    $value = db($arr[0])->getFieldById($arr[1], 'status');
    return ($value == 1) ? '启用' : '禁用';
}

/**
 * 获特殊情况文字
 * @param string $type [从session取得的文字]
 * @param string       [返回字符]
 * @author SpringYang <ceroot@163.com>
 */
function get_log_session_text($type)
{
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
function action_log($record_id = null, $action = null, $model = null, $user_id = UID)
{
    // 参数检查
    if (empty($record_id)) {
        return '参数不能为空';
    }

    if (empty($model)) {
        $model = request()->controller();
    }

    if (empty($action)) {
        $action = request()->action();
    }

    $action = $model . '_' . $action;
    $action = strtolower($action); // 小写转换

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
            $log['user']     = $user_id;
            $log['record']   = $record_id;
            $log['model']    = $model;
            $log['time']     = time();
            $log['table_id'] = $model . '|' . $record_id;
            $log['type']     = session('log_text');
            $log['data']     = array('user' => $user_id, 'model' => $model, 'record' => $record_id, 'time' => time());

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
    $data['action_id']   = $action_info['id'];
    $data['user_id']     = $user_id;
    $data['action_ip']   = ip2int();
    $data['model']       = $model;
    $data['record_id']   = $record_id;
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
 * @param  array   $rules     [解析后的规则数组]
 * @param  int     $action_id [行为id]
 * @param  array   $user_id   [执行的用户id]
 * @return boolean            [false 失败 ， true 成功]
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
 * 将驼峰式命名转换为下划线命名
 * @param  string $str [字符串]
 * @return string      [返回字符]
 * @author SpringYang <ceroot@163.com>
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
 * @param  string $str [字符串]
 * @return string      [返回字符]
 * @author SpringYang <ceroot@163.com>
 */
function toCamel($str)
{
    $str = ucwords(str_replace('_', ' ', $str));
    $str = str_replace(' ', '', lcfirst($str));
    return $str;
}

/**
 * 退出 url
 * @return     string  [url地址]
 * @author SpringYang <ceroot@163.com>
 */
function logouturl()
{
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
function getbackurl()
{
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
 * @param  int       $numeric    [类型 0为数字，1为全部，2为大小写，3为数字加大写，4为数字加小写，5为大写，6为小写，7为uniqid()]
 * @return string    $hash       [返回数字]
 * @author SpringYang <ceroot@163.com>
 */
function getrandom($length = 6, $numeric = 0)
{
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
            $max   = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
            break;
        case 2:
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz';
            $max   = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
            break;
        case 3:
            $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
            $max   = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
            break;
        case 4:
            $chars = '23456789abcdefghjkmnpqrstuvwxyz';
            $max   = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        case 5:
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
            $max   = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
            break;
        case 6:
            $chars = 'abcdefghjkmnpqrstuvwxyz';
            $max   = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
            break;
        case 7:
            $uniqid = implode(null, array_map('ord', str_split(md5(uniqid()), 1)));
            $max    = strlen($uniqid) - 1;
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
 * @return string    $tags       [返回分词]
 * @author SpringYang <ceroot@163.com>
 */
function get_keywords($str, $lenght = 10, $separator = ',')
{
    $str = strip_tags($str); // 去掉 html 代码
    $str = str_replace(' ', '', $str); // 去掉空格
    $str = str_replace('&nbsp;', '', $str); // 去掉 &nbsp;

    Vendor('scws.pscws4');
    $pscws = new \PSCWS4();
    $pscws->set_dict(VENDOR_PATH . 'scws/lib/dict.utf8.xdb');
    $pscws->set_rule(VENDOR_PATH . 'scws/lib/rules.utf8.ini');
    $pscws->set_ignore(true);
    $pscws->send_text($str);
    $words = $pscws->get_tops($lenght);
    $pscws->close();

    $end  = end($words);
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
 * 取得描述
 * @param  string    $str          [需要分词的字符串]
 * @param  string    $lenght       [分文词长度，默认为120个]
 * @return string    $description  [返回描述]
 * @author SpringYang <ceroot@163.com>
 */
function get_description($str, $lenght = 120)
{
    $pattern = '/<p[^>]*>(.*?)<\/p>/'; // 因为 ueditor 是以 p 标签来做段落
    $preg    = preg_match($pattern, $str, $matches);
    // 当能够正常匹配的时候就使用匹配的值，当不能匹配的时候取默认值
    if ($preg) {
        $description = mb_substr(strip_tags($matches[1]), 0, $lenght);
        if (empty($description)) {
            $description = mb_substr(strip_tags($str), 0, $lenght);
        }
    } else {
        $description = mb_substr(strip_tags($str), 0, $lenght);
    }

    $description = str_replace(' ', '', $description); // 去掉空格
    $description = str_replace('&nbsp;', '', $description); // 去掉 &nbsp
    return $description;
}

/**
 * 修改文章时删除原来数据库里被修改去的图片或者文件
 * @param  string    $dataForm    [表单提交过来的数据]
 * @param  string    $dataSql     [数据库里的数据]
 * @return string
 * @author SpringYang <ceroot@163.com>
 */
function del_file($dataForm, $dataSql)
{
    // 定义变量
    $differ = [];
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

    // 如果表单数据不为空的话就去和数据库作对比并删除不需要进行删除的数据;
    if (!empty($imgForm) && !empty($imgSql)) {
        if (is_array($imgForm) && is_array($imgSql)) {
            $imgIntersect = array_intersect($imgForm, $imgSql); // 取得交集
            $imgDiffer    = array_diff($imgSql, $imgIntersect); // 取得差集
            $differ       = array_merge($differ, $imgDiffer); // 合并数组并统一赋值给 $differ
        }
    }

    // 取得a标签正则
    $patternHref = '<a.*?href="(.*?)">';
    // 匹配表单数据并取得数据
    if (preg_match_all($patternHref, $dataForm, $matchesHrefForm)) {
        $hrefForm = $matchesHrefForm[1];
    }

    // 匹配数据库数据并取得数据
    if (preg_match_all($patternHref, $dataSql, $matchesHrefSql)) {
        $hrefSql = $matchesHrefSql[1];
    }

    // 如果表单数据不为空的话就去和数据库作对比并删除不需要进行删除的数据;
    if (!empty($hrefForm) && !empty($hrefSql)) {
        if (is_array($hrefForm) && is_array($hrefSql)) {
            $hrefIntersect = array_intersect($hrefForm, $hrefSql); // 取得交集
            $hrefDiffer    = array_diff($hrefSql, $hrefIntersect); // 取得差集
            $differ        = array_merge($differ, $hrefDiffer); // 合并数组并统一赋值给 $differ
        }
    }

    // 如果进行处理后的数据不为空则执行删除操作
    if (!empty($differ) && is_array($differ)) {
        foreach ($differ as $value) {
            $urlarr = parse_url($value);
            $path   = $urlarr['path'];
            if (is_file('.' . $path)) {
                unlink('.' . $path);
            }
        }
    }

}

/**
 * 处理 ueditor 富文本编辑器对图片和文件及其它的处理
 * @param  string    $content    [表单提交过来的内容]
 * @param  string    $title      [标题内容，用于图片的 alt 和 title 属性值，默认为 null，不执行]
 * @return string    $content    [返回新的内容]
 * @author SpringYang <ceroot@163.com>
 */
function ueditor_handle($content, $title = null)
{
    $pathFiles  = './data/files/'; // 文件保存路径
    $pathImages = './data/images/'; // 图片保存路径
    $pathVideos = './data/videos/'; // 视频保存路径

    // 图片替换处理
    // $patternImg = '<img.*?src="(.*?)">';
    $patternImg = '/<img.*?src="(.*?)".*?>/is';
    if (preg_match_all($patternImg, $content, $matchesImg)) {
        foreach ($matchesImg[0] as $key => $value) {
            $oldValue = $newValue = $value; // 临时变量
            if (stripos($value, 'data/ueditor') !== false) {
                $imageSrc   = $matchesImg[1][$key]; // 取得 img 里的 src
                $imagesArr  = explode('/', $imageSrc); // 以 / 拆分 src 变为数组
                $imagesName = end($imagesArr); // 取得数组里的最后一个值，也就是文件名
                $datePath   = array_slice($imagesArr, -2, 1); // 取得数组里的倒数第二个值，也就是以日期命名的目录
                $newPath    = $pathImages . $datePath[0] . '/'; // 新的文件目录

                // 判断目录是否存在，如果不存在则创建
                if (!is_dir($newPath)) {
                    make_dir($newPath);
                }

                // 文件移动
                $newPath  = $newPath . $imagesName; // 新路径
                $imageSrc = '.' . $imageSrc; // 旧路径
                if (is_file($imageSrc)) {
                    // 取得文件信息
                    $imageInfo = getimagesize($imageSrc);
                    if ($imageInfo) {
                        if ($imageInfo[0] > 800) {
                            // 实例化图片尺寸类
                            $newimage = new \imageresize\ImageResize();
                            $result   = $newimage->resize($imageSrc, $newPath, 800, 500);
                            if ($result) {
                                unlink($imageSrc); // 删除临时文件
                            }
                        } else {
                            rename($imageSrc, $newPath);
                        }
                    }
                }

            }

            if (stripos($value, 'data/') !== false) {
                // 如果标题存在的时候进行操作
                if (!empty($title)) {
                    // alt 替换
                    $patternAlt = '/<img.*alt\=[\"|\'](.*)[\"|\'].*>/i'; // alt 规则
                    $newAlt     = 'alt="' . $title . '"'; // 新的 alt

                    $altPreg = preg_match($patternAlt, $oldValue, $matchAlt);
                    if ($altPreg) {
                        $newValue = preg_replace('/alt=.+?[*|\"]/i', $newAlt, $newValue);
                    } else {
                        $valueTemp = str_replace('/>', '', $newValue);
                        $newValue  = $valueTemp . ' ' . $newAlt . '/>';
                    }

                    // 标题替换处理
                    $patternTitle = '/<img.*title\=[\"|\'](.*)[\"|\'].*>/i'; // title 规则
                    $newTitle     = 'title="' . $title . '"'; // 新的 title

                    $titlePreg = preg_match($patternTitle, $oldValue, $matchTitle);
                    if ($titlePreg) {
                        $newValue = preg_replace('/title=.+?[*|\"]/i', $newTitle, $newValue);
                    } else {
                        $valueTemp = str_replace('/>', '', $newValue);
                        $newValue  = $valueTemp . ' ' . $newTitle . '/>';
                    }
                }

                // 样式为空替换处理
                $stylePattern = '<img.*?style="(.*?)">'; // style 规则
                $stylePreg    = preg_match($stylePattern, $oldValue, $styleMatch);
                if ($stylePreg) {
                    if (empty($styleMatch[1])) {
                        $newValue = preg_replace('/style=.+?[*|\"]/i', '', $newValue);
                    }
                }

                // 替换成新的图片路径
                $newValue = str_replace('ueditor/', '', $newValue);

                // 内容替换成新的值
                $content = str_replace($oldValue, $newValue, $content);
            }
        }
    }

    // 文件替换处理
    if (preg_match_all("'<\s*a\s.*?href\s*=\s*([\"\'])?(?(1)(.*?)\\1|([^\s\>]+))[^>]*>?(.*?)</a>'isx", $content, $links)) {
        while (list($key, $val) = each($links[2])) {
            if (!empty($val)) {
                $match['link'][] = $val;
            }
        }
        while (list($key, $val) = each($links[3])) {
            if (!empty($val)) {
                $match['link'][] = $val;
            }
        }
        while (list($key, $val) = each($links[4])) {
            if (!empty($val)) {
                $match['content'][] = $val;
            }
        }
        while (list($key, $val) = each($links[0])) {
            if (!empty($val)) {
                $match['all'][] = $val;
            }

        }

        // 文件地址处理
        foreach ($match['link'] as $value) {
            if (stripos($value, 'data/ueditor') !== false) {
                $oldValue = $value;
                $linkArr  = explode('/', $value);
                $datePath = array_slice($linkArr, -2, 1);
                $fileName = end($linkArr);
                $newPath  = $pathFiles . $datePath[0] . '/';

                // 判断目录是否存在，如果不存在则创建
                if (!is_dir($newPath)) {
                    make_dir($newPath);
                }

                // 移动文件
                $newPath = $newPath . $fileName; // 新路径
                $value   = '.' . $value; // 旧路径
                if (is_file($value)) {
                    rename($value, $newPath);
                }

                // 替换成新的文件路径
                $newvalue = str_replace('ueditor/', '', $oldValue);

                // 内容替换成新的值
                $content = str_replace($oldValue, $newvalue, $content);
            }
        }
    }

    // 附件小图标处理
    if (stripos($content, 'ueditor/1.4.3.2/dialogs/attachment') !== false) {
        $content = str_replace('ueditor/1.4.3.2/dialogs/attachment', 'images', $content);
    }
    return $content;
}

/**
 * 获取插件类的类名
 * @param strng $name 插件名
 */
function get_addon_class($name)
{
    // dump($name);
    $dd = lcfirst($name);
    // $class = CODE_PATH . "addons\\{$name}\\{$name}Addon";
    $class = "addons\\{$dd}\\{$name}Addon";
    // $class = CODE_PATH . 'addons/' . strtolower($name) . '/' . $name;
    return $class;
}

/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map  映射关系二维数组  array(
 *                                          '字段名1'=>array(映射关系数组),
 *                                          '字段名2'=>array(映射关系数组),
 *                                           ......
 *                                       )
 * @author 朱亚杰 <zhuyajie@topthink.net>
 * @return array
 *
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 *
 */
function int_to_string(&$data, $map = array('status' => array(1 => '正常', -1 => '删除', 0 => '禁用', 2 => '未审核', 3 => '草稿')))
{
    if ($data === false || $data === null) {
        return $data;
    }
    $data = (array) $data;
    foreach ($data as $key => $row) {
        foreach ($map as $col => $pair) {
            if (isset($row[$col]) && isset($pair[$row[$col]])) {
                $data[$key][$col . '_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby = 'asc')
{
    // dump($list);die;
    if (is_array($list)) {
        $refer = $resultSet = array();
        foreach ($list as $i => $data) {
            $refer[$i] = &$data[$field];
        }

        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val) {
            $resultSet[] = &$list[$key];
        }

        return $resultSet;
    }
    return false;
}

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function str2arr($str, $glue = ',')
{
    return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function arr2str($arr, $glue = ',')
{
    return implode($glue, $arr);
}

/**
 * 处理插件钩子
 * @param string $hook   钩子名称
 * @param mixed $params 传入参数
 * @return void
 */
function hook($hook, $params = array())
{
    \think\Hook::listen($hook, $params);
}

/**
 * 插件显示内容里生成访问插件的url
 * @param string $url url
 * @param array $param 参数
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function addons_url($url, $param = array())
{
    $url = parse_url($url);

    $case = true; //C('URL_CASE_INSENSITIVE');
    // $addons     = $case ? parse_name($url['scheme']) : $url['scheme'];
    // $controller = $case ? parse_name($url['host']) : $url['host'];
    // $action     = trim($case ? strtolower($url['path']) : $url['path'], '/');

    $addons     = $url['scheme'];
    $controller = $url['host'];
    $action     = trim($url['path'], '/');

    /* 解析URL带的参数 */
    if (isset($url['query'])) {
        parse_str($url['query'], $query);
        $param = array_merge($query, $param);
    }

    /* 基础参数 */
    $params = array(
        '_addons'     => $addons,
        '_controller' => $controller,
        '_action'     => $action,
    );

    $params = array_merge($params, $param); //添加额外参数
    $url    = url('addons/execute', $params);
    return $url;
    dump($url);die;
    return U('Addons/execute', $params);
}

/**
 * 调用系统的API接口方法（静态方法）
 * api('User/getName','id=5'); 调用公共模块的User接口的getName方法
 * api('Admin/User/getName','id=5');  调用Admin模块的User接口
 * @param  string  $name 格式 [模块名]/接口名/方法名
 * @param  array|string  $vars 参数
 */
function api($name, $vars = array())
{
    $array = explode('/', $name);

    $method = array_pop($array);

    $classname = array_pop($array);

    $module = $array ? array_pop($array) : 'common';

    $callback = '\\' . $module . '\\api\\' . $classname . 'Api::' . $method;

    if (is_string($vars)) {
        parse_str($vars, $vars);
    }
    dump(call_user_func_array($callback, $vars));
    die;
    return call_user_func_array($callback, $vars);
}

// 分析枚举类型配置值 格式 a:名称1,b:名称2
function parse_config_attr($string)
{
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if (strpos($string, ':')) {
        $value = array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    } else {
        $value = $array;
    }
    return $value;
}

// 分析枚举类型字段值 格式 a:名称1,b:名称2
// 暂时和 parse_config_attr功能相同
// 但请不要互相使用，后期会调整
function parse_field_attr($string)
{
    if (0 === strpos($string, ':')) {
        // 采用函数定义
        return eval('return ' . substr($string, 1) . ';');
    } elseif (0 === strpos($string, '[')) {
        // 支持读取配置参数（必须是数组类型）
        return config(substr($string, 1, -1));
    }

    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if (strpos($string, ':')) {
        $value = array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    } else {
        $value = $array;
    }
    return $value;
}

/**
 * 获取客户端浏览器信息 添加win10 edge浏览器判断
 * @author
 * @return string
 */
function getBroswer()
{
    $sys = $_SERVER['HTTP_USER_AGENT']; //获取用户代理字符串
    if (stripos($sys, "Firefox/") > 0) {
        preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
        $exp[0] = "Firefox";
        $exp[1] = $b[1]; //获取火狐浏览器的版本号
    } elseif (stripos($sys, "Maxthon") > 0) {
        preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
        $exp[0] = "傲游";
        $exp[1] = $aoyou[1];
    } elseif (stripos($sys, "MSIE") > 0) {
        preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
        $exp[0] = "IE";
        $exp[1] = $ie[1]; //获取IE的版本号
    } elseif (stripos($sys, "OPR") > 0) {
        preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
        $exp[0] = "Opera";
        $exp[1] = $opera[1];
    } elseif (stripos($sys, "Edge") > 0) {
        //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
        preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
        $exp[0] = "Edge";
        $exp[1] = $Edge[1];
    } elseif (stripos($sys, "Chrome") > 0) {
        preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
        $exp[0] = "Chrome";
        $exp[1] = $google[1]; //获取google chrome的版本号
    } elseif (stripos($sys, 'rv:') > 0 && stripos($sys, 'Gecko') > 0) {
        preg_match("/rv:([\d\.]+)/", $sys, $IE);
        $exp[0] = "IE";
        $exp[1] = $IE[1];
    } elseif (stripos($sys, 'Safari') > 0) {
        preg_match("/safari\/([^\s]+)/i", $sys, $safari);
        $exp[0] = "Safari";
        $exp[1] = $safari[1];
    } else {
        $exp[0] = "未知浏览器";
        $exp[1] = "";
    }
    return $exp[0] . '(' . $exp[1] . ')';
}

/**
 * 获取客户端操作系统信息包括win10
 * @author
 * @return string
 */
function getOs()
{
    $agent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/win/i', $agent) && strpos($agent, '95')) {
        $os = 'Windows 95';
    } else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')) {
        $os = 'Windows ME';
    } else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent)) {
        $os = 'Windows 98';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent)) {
        $os = 'Windows Vista';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent)) {
        $os = 'Windows 7';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent)) {
        $os = 'Windows 8';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent)) {
        $os = 'Windows 10'; #添加win10判断
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)) {
        $os = 'Windows XP';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)) {
        $os = 'Windows 2000';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)) {
        $os = 'Windows NT';
    } else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent)) {
        $os = 'Windows 32';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux';
    } else if (preg_match('/unix/i', $agent)) {
        $os = 'Unix';
    } else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'SunOS';
    } else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'IBM OS/2';
    } else if (preg_match('/Mac/i', $agent)) {
        $os = 'Mac';
    } else if (preg_match('/PowerPC/i', $agent)) {
        $os = 'PowerPC';
    } else if (preg_match('/AIX/i', $agent)) {
        $os = 'AIX';
    } else if (preg_match('/HPUX/i', $agent)) {
        $os = 'HPUX';
    } else if (preg_match('/NetBSD/i', $agent)) {
        $os = 'NetBSD';
    } else if (preg_match('/BSD/i', $agent)) {
        $os = 'BSD';
    } else if (preg_match('/OSF1/i', $agent)) {
        $os = 'OSF1';
    } else if (preg_match('/IRIX/i', $agent)) {
        $os = 'IRIX';
    } else if (preg_match('/FreeBSD/i', $agent)) {
        $os = 'FreeBSD';
    } else if (preg_match('/teleport/i', $agent)) {
        $os = 'teleport';
    } else if (preg_match('/flashget/i', $agent)) {
        $os = 'flashget';
    } else if (preg_match('/webzip/i', $agent)) {
        $os = 'webzip';
    } else if (preg_match('/offline/i', $agent)) {
        $os = 'offline';
    } elseif (preg_match('/ucweb|MQQBrowser|J2ME|IUC|3GW100|LG-MMS|i60|Motorola|MAUI|m9|ME860|maui|C8500|gt|k-touch|X8|htc|GT-S5660|UNTRUSTED|SCH|tianyu|lenovo|SAMSUNG/i', $agent)) {
        $os = 'mobile';
    } else {
        $os = '未知操作系统';
    }
    return $os;
}
