<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {

        return $this->fetch();
    }

    public function test()
    {
        //return $this->fetch('../code/template/public/menu.tpl');
        //$dd = controller('addons://oauth@oauth');

        echo '控制器：（CONTROLLER_NAME）';
        dump(CONTROLLER_NAME);
        echo '<hr>';
        echo '时间：（NOW_TIME）';
        dump(NOW_TIME);
        echo '<hr>';
        echo '控制器：request()->controller()';
        dump(request()->controller());
        return $this->fetch();
    }

    public function hello()
    {
        $qin = new \think\auth\Qin();
        $qin = $qin->hello();
        dump(qin());
    }

    public function df()
    {
        $arr1 = [
            "/data/images/20160614/3fabb29358443fb41ee2142b638d64d8.jpg",
            "/data/images/20160614/185e3b05db16acfbf4bb5897d84d1e98.jpg",
            "/data/images/20160614/e88cd9d103d02da0ba441770baf66385.jpg",
            "/data/images/20160614/e8e2991621e9f21d9a02becc908b02d0.jpg",
        ];

        echo '数组1：';
        dump($arr1);

        $arr2 = [
            "/data/images/20160614/9c2d2e78c8aac48673a7bac23194ca45.jpg",
            "/data/images/20160614/3fabb29358443fb41ee2142b638d64d8.jpg",
            "/data/images/20160614/185e3b05db16acfbf4bb5897d84d1e98.jpg",
            "/data/images/20160614/e88cd9d103d02da0ba441770baf66385.jpg",
            "/data/images/20160614/e8e2991621e9f21d9a02becc908b02d0.jpg",
        ];

        echo '数组2：';
        dump($arr2);

        $jj = array_intersect($arr1, $arr2);
        echo '交集：';
        dump($jj);

        $cj = array_diff($arr2, $arr1);
        echo '差集：';
        dump($cj);

        $arr3 = [1];
        $arr4 = [1, 2, 3, 4];
        $arr5 = array_merge_recursive($arr3, $arr4);
        dump($arr5);

        dump(is_file('./data/images/20160614/3fabb29358443fb41ee2142b638d64d8.jpg'));
        dump(file_exists('./data/images/20160614/3fabb29358443fb41ee2142b638d64d8.jpg'));
    }

    public function zs()
    {
        dump('zs');
        dump(config('app_debug'));
        dump(config('web_site_title'));
    }

    public function ls()
    {
        dump('ls');
    }

    public function wexin()
    {
        //https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=ACCESS_TOKEN
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxd5e8db24ff394381&secret=ad7ee26884853794b050861c4032a44d";
        $ch  = curl_init(); //初始化
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $jsoninfo     = json_decode($output, true);
        $access_token = $jsoninfo['access_token'];
        // dump($jsoninfo);die;

        $url = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=' . $access_token;
        //https://api.weixin.qq.com/cgi-bin/menu/get?access_token=ACCESS_TOKEN
        $ch = curl_init(); //初始化
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $dd = curl_exec($ch);
        curl_close($ch);
        dump($dd);die;

        $we_menu = db('we_menu')->where(array('we_menu_leftid' => 0, 'we_menu_open' => 1))->order('we_menu_order')->limit(3)->select();

        $data = '{"button":['; //菜单头
        foreach ($we_menu as $v) {
            $data .= '{"name":"' . $v['we_menu_name'] . '",'; //菜单名称

            $count = db('we_menu')->where(array('we_menu_leftid' => $v['we_menu_id'], 'we_menu_open' => 1))->limit(5)->order('we_menu_order')->count(); //判断是否有子栏目
            if ($count) {
//二级栏目
                $data .= '"sub_button":[';
                $we_twomenu = db('we_menu')->where(array('we_menu_leftid' => $v['we_menu_id'], 'we_menu_open' => 1))->order('we_menu_order')->limit(5)->select();
                $k          = 0;
                foreach ($we_twomenu as $t) {
                    $k = $k + 1;
                    $data .= '{"name":"' . $t['we_menu_name'] . '",';
                    $data .= '"type":"view",';
                    $data .= '"url":"http://www.baidu.com"';
                    if ($k == $count) {
                        $data .= '}';
                    } else {
                        $data .= '},';
                    }
                }
                $data .= ']},';
            } else {
                $data .= '"type":"view",';
                $data .= '"url":"http://www.baidu.com"';
            }
        }
        $data .= '},]';
        $data .= '}';

        // dump($data);

        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $ch  = curl_init(); //初始化
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // $this->success('菜单生成成功', U('we_menu'), 1);
        curl_exec($ch);
        curl_close($ch);
        // return $access_token;
    }

    /**
     * 数据XML编码
     * @param  object $xml  XML对象
     * @param  mixed  $data 数据
     * @param  string $item 数字索引时的节点名称
     * @return string
     */
    protected static function data2xml($xml, $data, $item = 'item')
    {
        foreach ($data as $key => $value) {
            /* 指定默认的数字key */
            is_numeric($key) && $key = $item;

            /* 添加子元素 */
            if (is_array($value) || is_object($value)) {
                $child = $xml->addChild($key);
                self::data2xml($child, $value, $item);
            } else {
                if (is_numeric($value)) {
                    $child = $xml->addChild($key, $value);
                } else {
                    $child = $xml->addChild($key);
                    $node  = dom_import_simplexml($child);
                    $cdata = $node->ownerDocument->createCDATASection($value);
                    $node->appendChild($cdata);
                }
            }
        }
    }

    /**
     * XML数据解码
     * @param  string $xml 原始XML字符串
     * @return array       解码后的数组
     */
    protected static function xml2data($xml)
    {
        $xml = new \SimpleXMLElement($xml);

        if (!$xml) {
            throw new \Exception('非法XXML');
        }

        $data = array();
        foreach ($xml as $key => $value) {
            $data[$key] = strval($value);
        }

        return $data;
    }

    public function test2()
    {
        $redata = array(
            'ToUserName'   => 'y',
            'FromUserName' => 'c',
            'CreateTime'   => time(),
            'MsgType'      => 'text',
            'Content'      => 'c',
            'FuncFlag'     => 0,
        );

        /* 转换数据为XML */
        $xml = new \SimpleXMLElement('<xml></xml>');
        $this->data2xml($xml, $redata);
        $dd = $xml->asXML();
        dump($dd);
    }

    public function test3()
    {
        $str = "<xml><ToUserName><![CDATA[y]]></ToUserName><FromUserName><![CDATA[c]]></FromUserName><CreateTime>1467182425</CreateTime><MsgType><![CDATA[t]]></MsgType></xml>";
        $dd  = $this->xml2data($str);

        dump($dd);
    }

    public function test4()
    {
        $type    = 'text';
        $content = '这是文字';
        $content = call_user_func(array(self, $type), $content);
        dump($content);
    }

    public function test5()
    {
        $dd = new \third\Yctest('dd');
        $df = $dd->sayHello('这是加进来的'); //$content
        //
        dump($df);
    }
}
