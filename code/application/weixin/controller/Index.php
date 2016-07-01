<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-28 16:00:18
 * @site      http://www.benweng.com
 */
namespace app\weixin\controller;

use app\common\controller\Extend;
use third\wechat\Wechat;
use third\wechat\WechatAuth;

class Index extends Extend
{
    /**
     * 微信消息接口入口
     * 所有发送到微信的消息都会推送到该操作
     * 所以，微信公众平台后台填写的api地址则为该操作的访问地址
     */
    public function index()
    {

        //调试
        try {

            $appid     = 'wxd5e8db24ff394381'; // AppID(应用ID)
            $appsecret = 'ad7ee26884853794b050861c4032a44d'; // 微信secret
            $token     = 'benweng'; // 微信后台填写的TOKEN
            $crypt     = 'dkYGTNzvKylvMTgY1aK9hNa5aWH43cnlxgTrMr9R3ds'; // 消息加密KEY（EncodingAESKey）

            /* 加载微信SDK */
            $wechat = new Wechat($token, $appid, $crypt);

            // $newmenu = array(
            //     array('type' => 'view', 'name' => 'menu1', 'url' => 'http://www.baidu.com'),
            //     array('type' => 'click', 'name' => 'menu2', 'key' => 'pro_intro'),
            //     array('name' => 'menu', "sub_button" => array(
            //         array('type' => 'view', 'name' => 'option1', 'url' => 'http://www.thinkphp.cn'),
            //         array('type' => 'view', 'name' => 'option2', 'url' => 'http://www.thinkphp.cn'),
            //         array('type' => 'click', 'name' => 'option3', 'key' => 'center_intro'),
            //     )),
            // );
            // $wechat = new WechatAuth($appid, $appsecret);
            // $WechatAuth->menuCreate($newmenu);
            // $WechatAuth->menuGet();

            /* 获取请求信息 */
            $data = $wechat->request();

            if ($data && is_array($data)) {
                /**
                 * 你可以在这里分析数据，决定要返回给用户什么样的信息
                 * 接受到的信息类型有10种，分别使用下面10个常量标识
                 * Wechat::MSG_TYPE_TEXT       //文本消息
                 * Wechat::MSG_TYPE_IMAGE      //图片消息
                 * Wechat::MSG_TYPE_VOICE      //音频消息
                 * Wechat::MSG_TYPE_VIDEO      //视频消息
                 * Wechat::MSG_TYPE_SHORTVIDEO //视频消息
                 * Wechat::MSG_TYPE_MUSIC      //音乐消息
                 * Wechat::MSG_TYPE_NEWS       //图文消息（推送过来的应该不存在这种类型，但是可以给用户回复该类型消息）
                 * Wechat::MSG_TYPE_LOCATION   //位置消息
                 * Wechat::MSG_TYPE_LINK       //连接消息
                 * Wechat::MSG_TYPE_EVENT      //事件消息
                 *
                 * 事件消息又分为下面五种
                 * Wechat::MSG_EVENT_SUBSCRIBE    //订阅
                 * Wechat::MSG_EVENT_UNSUBSCRIBE  //取消订阅
                 * Wechat::MSG_EVENT_SCAN         //二维码扫描
                 * Wechat::MSG_EVENT_LOCATION     //报告位置
                 * Wechat::MSG_EVENT_CLICK        //菜单点击
                 */

                //记录微信推送过来的数据
                file_put_contents('./data.json', json_encode($data));

                /* 响应当前请求(自动回复) */
                //$wechat->response($content, $type);

                /**
                 * 响应当前请求还有以下方法可以使用
                 * 具体参数格式说明请参考文档
                 *
                 * $wechat->replyText($text); //回复文本消息
                 * $wechat->replyImage($media_id); //回复图片消息
                 * $wechat->replyVoice($media_id); //回复音频消息
                 * $wechat->replyVideo($media_id, $title, $discription); //回复视频消息
                 * $wechat->replyMusic($title, $discription, $musicurl, $hqmusicurl, $thumb_media_id); //回复音乐消息
                 * $wechat->replyNews($news, $news1, $news2, $news3); //回复多条图文消息
                 * $wechat->replyNewsOnce($title, $discription, $url, $picurl); //回复单条图文消息
                 *
                 */

                //执行Demo
                $this->demo($wechat, $data);
                // return $wechat->replyText('欢迎访问麦当苗儿公众平台，这是文本回复的内容！');
            }
        } catch (\Exception $e) {
            file_put_contents('./error.json', json_encode($e->getMessage()));
        }

    }

    /**
     * DEMO
     * @param  Object $wechat Wechat对象
     * @param  array  $data   接受到微信推送的消息
     */
    private function demo($wechat, $data)
    {

        switch ($data['MsgType']) {
            case Wechat::MSG_TYPE_EVENT:
                switch ($data['Event']) {
                    case Wechat::MSG_EVENT_SUBSCRIBE:
                        $contentStr = "欢迎关注笨翁网公众平台，该公众平台有以下几种功能：\n\n";
                        $contentStr .= "1.输入“天气+地区”进行天气查询，如“天气贵阳”\n";
                        $contentStr .= "2.输入“翻译+内容”进行翻译，如“翻译你好”\n";
                        $contentStr .= "3.输入“身份证+身份号”进行查身份证相关信息，如“身份证420984198704207896”\n";
                        // $contentStr .= "3.输入“火车+发站+到站+月-天”进行查票，如“火车+贵阳+北京+08-21”\n";
                        //$contentStr.= "3.输入“城市+起点+终点”进行公交查询，如“石家庄+火车站+宫家庄”\n";
                        //$contentStr.= "4.输入“@任何内容”跟小贱鸡聊天，如“@小贱鸡”\n";
                        //$contentStr.= "5.微信发送您的地理位置进行天气查询，您可以试一试\n";
                        $contentStr .= "H.输入“h”或“help”或“帮助”，可以得到使用帮助，试试吧^~^\n\n";
                        $contentStr .= "提示：回复相关数据进行操作*！@";
                        // $wechat->replyText('欢迎您关注笨网网公众平台！回复“文本”，“图片”，“语音”，“视频”，“音乐”，“图文”，“多图文”查看相应的信息！');
                        $wechat->replyText($contentStr);
                        break;

                    case Wechat::MSG_EVENT_UNSUBSCRIBE:
                        //取消关注，记录日志
                        break;

                    default:
                        $wechat->replyText("欢迎访问笨翁网公众平台！您的事件类型：{$data['Event']}，EventKey：{$data['EventKey']}");
                        break;
                }
                break;

            case Wechat::MSG_TYPE_TEXT:
                switch ($data['Content']) {
                    case '文本':
                        $wechat->replyText('欢迎访问笨网网公众平台，这是文本回复的内容！');
                        break;

                    case '图片':
                        $media_id = $this->upload('image');
                        // $media_id = '1J03FqvqN_jWX6xe8F-VJr7QHVTQsJBS6x4uwKuzyLE';
                        $wechat->replyImage($media_id);
                        break;

                    case '语音':
                        //$media_id = $this->upload('voice');
                        $media_id = '1J03FqvqN_jWX6xe8F-VJgisW3vE28MpNljNnUeD3Pc';
                        $wechat->replyVoice($media_id);
                        break;

                    case '视频':
                        //$media_id = $this->upload('video');
                        $media_id = '1J03FqvqN_jWX6xe8F-VJn9Qv0O96rcQgITYPxEIXiQ';
                        $wechat->replyVideo($media_id, '视频标题', '视频描述信息。。。');
                        break;

                    case '音乐':
                        //$thumb_media_id = $this->upload('thumb');
                        $thumb_media_id = '1J03FqvqN_jWX6xe8F-VJrjYzcBAhhglm48EhwNoBLA';
                        $wechat->replyMusic(
                            'Wakawaka!',
                            'Shakira - Waka Waka, MaxRNB - Your first R/Hiphop source',
                            'http://wechat.zjzit.cn/Public/music.mp3',
                            'http://wechat.zjzit.cn/Public/music.mp3',
                            $thumb_media_id
                        ); //回复音乐消息
                        break;

                    case '图文':
                        $wechat->replyNewsOnce(
                            "全民创业蒙的就是你，来一盆冷水吧！",
                            "全民创业已经如火如荼，然而创业是一个非常自我的过程，它是一种生活方式的选择。从外部的推动有助于提高创业的存活率，但是未必能够提高创新的成功率。第一次创业的人，至少90%以上都会以失败而告终。创业成功者大部分年龄在30岁到38岁之间，而且创业成功最高的概率是第三次创业。",
                            "http://www.topthink.com/topic/11991.html",
                            "http://yun.topthink.com/Uploads/Editor/2015-07-30/55b991cad4c48.jpg"
                        ); //回复单条图文消息
                        break;

                    case '多图文':
                        $news = array(
                            "全民创业蒙的就是你，来一盆冷水吧！",
                            "全民创业已经如火如荼，然而创业是一个非常自我的过程，它是一种生活方式的选择。从外部的推动有助于提高创业的存活率，但是未必能够提高创新的成功率。第一次创业的人，至少90%以上都会以失败而告终。创业成功者大部分年龄在30岁到38岁之间，而且创业成功最高的概率是第三次创业。",
                            "http://www.topthink.com/topic/11991.html",
                            "http://yun.topthink.com/Uploads/Editor/2015-07-30/55b991cad4c48.jpg",
                        ); //回复单条图文消息

                        $wechat->replyNews($news, $news, $news, $news, $news);
                        break;
                    case '1':
                        $appid     = 'wxd5e8db24ff394381'; // AppID(应用ID)
                        $appsecret = 'ad7ee26884853794b050861c4032a44d'; // 微信secret
                        $auth      = new WechatAuth($appid, $appsecret);
                        $token     = $auth->getAccessToken();
                        // $token = $auth->test();
                        $wechat->replyText($token);
                        $filename = './images/boxed-bg.jpg';

                        $type  = 'image';
                        $media = $auth->materialAddMaterial($filename, $type);
                        $wechat->replyText($media);
                        $dd = $media['media_id'];

                        break;
                    default:

                        if (substr($data['Content'], 0, 6) == '天气' || substr($data['Content'], 0, 2) == 'tq' || substr($data['Content'], 0, 6) == 'tianqi') {
                            $keyword  = $data['Content'];
                            $cityname = trim(substr($keyword, 6, strlen($keyword) - 6));
                            $bdak     = '5f13fb033233c5fc781b12a2d54d7ce4';

                            $content = $this->getWeather($cityname, $bdak);
                        } elseif (substr($data['Content'], 0, 6) == '翻译') {
                            $keyword = $data['Content'];
                            $keyword = trim(substr($keyword, 6, strlen($keyword) - 6));
                            $content = $this->fanyi($keyword);
                        } elseif (substr($data['Content'], 0, 6) == '笑话') {
                            $keyword = $data['Content'];
                            $content = $this->getJoke($keyword);
                        } elseif (substr($data['Content'], 0, 9) == '身份证') {
                            $keyword = $data['Content'];
                            $idCard  = trim(substr($keyword, 9, strlen($keyword) - 9));
                            $content = $this->getIdCardInfo($idCard);
                        } elseif ($data['Content'] == 'help' || $data['Content'] == 'HELP' || $data['Content'] == 'h' || $data['Content'] == 'H' || $data['Content'] == '帮助' || $data['Content'] == 'more' || $data['Content'] == 'MORE' || $data['Content'] == 'm' || $data['Content'] == 'M' || $data['Content'] == '更多') {
                            $contentStr = "使用帮助：\n";
                            $contentStr .= "1.输入“天气+地区”进行天气查询，如“天气贵阳”\n";
                            $contentStr .= "2.输入“翻译+内容”进行翻译，如“翻译你好”\n";
                            $contentStr .= "3.输入“身份证+身份号”进行查身份证相关信息，如“身份证420984198704207896”\n";
                            //$contentStr .= "3.输入“火车+发站+到站+月-天”进行查票，如“火车+贵阳+北京+08-21”\n";
                            //$contentStr   .= "3.输入“城市+起点+终点”进行公交查询，如“石家庄+火车站+宫家庄”\n";
                            //$contentStr   .= "4.输入“@任何内容”跟小贱鸡聊天，如“@小贱鸡”\n";
                            //$contentStr   .= "5.微信发送您的地理位置进行天气查询，您可以试一试\n";
                            $contentStr .= "M.输入“m”或“more”或“更多”，可以得到更多内容，试试吧^~^\n";
                            $contentStr .= "H.输入“h”或“help”或“帮助”，可以得到使用帮助，试试吧^~^";

                            $content = $contentStr;
                        } else {
                            // $content = "欢迎访问笨翁网公众平台！您输入的内容是：{$data['Content']}";

                            $content = $this->getJoke(1);
                        }
                        $wechat->replyText($content);
                        break;
                }
                break;

            default:
                # code...
                break;
        }
    }

    private function getWeather($cityname, $bdak)
    {
        $url = "http://api.map.baidu.com/telematics/v2/weather?location={$cityname}&ak={$bdak}";
        $fa  = file_get_contents($url);
        $f   = simplexml_load_string($fa);
        if ($f->status == 'success') {
            $city = $f->currentCity;
            $da1  = $f->results->result[0]->date;
            $da2  = $f->results->result[1]->date;
            $da3  = $f->results->result[2]->date;
            $da4  = $f->results->result[3]->date;
            $w1   = $f->results->result[0]->weather;
            $w2   = $f->results->result[1]->weather;
            $w3   = $f->results->result[2]->weather;
            $w4   = $f->results->result[3]->weather;
            $p1   = $f->results->result[0]->wind;
            $p2   = $f->results->result[1]->wind;
            $p3   = $f->results->result[2]->wind;
            $p4   = $f->results->result[3]->wind;
            $q1   = $f->results->result[0]->temperature;
            $q2   = $f->results->result[1]->temperature;
            $q3   = $f->results->result[2]->temperature;
            $q4   = $f->results->result[3]->temperature;
            if ($da1 == "") {
                $msg = "您要查询的“" . $cityname . "”没有查询到相关天气数据，请检查地址是否正确再进行查询！";
            } else {
                $d1  = $da1 . "\r\n" . $w1 . $p1 . $q1 . "\r\n";
                $d2  = $da2 . "\r\n" . $w2 . $p2 . $q2 . "\r\n";
                $d3  = $da3 . "\r\n" . $w3 . $p3 . $q3 . "\r\n";
                $d4  = $da4 . "\r\n" . $w4 . $p4 . $q4;
                $msg = $cityname . "未来四天天气：\r\n" . $d1 . $d2 . $d3 . $d4;
            }
        } else {
            $msg = '没有查询到相关数据';
        }
        return $msg;
    }

    private function fanyi($keyword)
    {
        $result = translate($keyword, 'auto', 'en');
        $result = $result['trans_result'][0]['dst'];
        return $result;
        // $baidu_apikey = '6AajKGB9NtytEpBWHO3sH7gl';
        // $tranurl      = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=" . $baidu_apikey . "&q={$keyword}&from=auto&to=auto"; //百度翻译地址
        // $transtr      = file_get_contents($tranurl); //读入文件
        // $transon      = json_decode($transtr); //json解析
        // $contentStr   = $transon->trans_result[0]->dst; //读取翻译内容
        // return $contentStr;
    }

    private function getIdCardInfo($idCard)
    {
        $ch = curl_init();
        // $url    = 'http://apis.baidu.com/apistore/idservice/id?id=420984198704207896';
        $url    = 'http://apis.baidu.com/apistore/idservice/id?id=' . $idCard;
        $header = array(
            'apikey: 2bcf4474ed281885e1049db326c4b0b9',
        );
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);
        $res = json_decode($res);

        if ($res->errNum == '-1') {
            return $res->retMsg;
        }

        $res = $res->retData;

        switch ($res->sex) {
            case 'M':
                $sex = '男';
                break;
            case 'F':
                $sex = '女';
                break;
            default:
                $sex = '未知'; // 未知是N
                break;
        }

        $redata = '身份证号：' . $idCard . "\r\n";
        $redata .= '来自：' . $res->address . "\r\n";
        $redata .= '出生日期：' . $res->birthday . "\r\n";
        $redata .= '性别：' . $sex;
        return $redata;
        // dump(json_decode($res));
    }

    private function getJoke($keyword)
    {
        $db    = db('joke');
        $count = db('joke')->count();
        $id    = rand(1, $count);
        $data  = db('joke')->where('id', $id)->value('content');
        return $data;
    }

    /**
     * 资源文件上传方法
     * @param  string $type 上传的资源类型
     * @return string       媒体资源ID
     */
    private function upload($type)
    {
        $appid     = 'wxd5e8db24ff394381';
        $appsecret = 'ad7ee26884853794b050861c4032a44d';

        $token = session("token");

        if ($token) {
            $auth = new WechatAuth($appid, $appsecret, $token);
        } else {
            $auth  = new WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);
        }

        switch ($type) {
            case 'image':
                $filename = './images/boxed-bg.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'voice':
                $filename = './public/voice.mp3';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'video':
                $filename    = './public/video.mp4';
                $discription = array('title' => '视频标题', 'introduction' => '视频描述');
                $media       = $auth->materialAddMaterial($filename, $type, $discription);
                break;

            case 'thumb':
                $filename = './public/music.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            default:
                return '';
        }

        if ($media["errcode"] == 42001) {
            //access_token expired
            session("token", null);
            $this->upload($type);
        }

        return $media['media_id'];
    }

}
