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

class Index extends Extend
{
    public function index()
    {
        // $mp_weixin = input('mp_weixin');
        // dump($mp_weixin);die;
        // if (!$mp_weixin) {
        //     return $this->error('参数错误');
        // }
        // if ($mp_weixin == 'benweng') {
        //     $token = 'benwng';
        // }

        $echoStr   = $_GET["echostr"];
        $mp_weixin = input('mp_weixin'); //'benweng';
        //valid signature , option
        switch ($mp_weixin) {
            case 'benweng':
                $token = 'benweng';
                break;
            case 'benweng2':
                $token = 'benweng2';
                break;
            case 'benweng3':
                $token = 'benweng3';
                break;
            case 'benweng4':
                $token = 'benweng4';
                break;
            default:
                $token = 'benweng0';
                break;
        }

        if ($this->checkSignature($token)) {
            return $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
            the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj      = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername   = $postObj->ToUserName;
            $keyword      = trim($postObj->Content);
            $time         = time();
            $textTpl      = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if (!empty($keyword)) {
                $msgType    = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr  = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "Input something...";
            }

        } else {
            echo "";
            exit;
        }
    }

    private function checkSignature($token)
    {
        // you must define TOKEN by yourself
        // if (!defined("TOKEN")) {
        //     throw new Exception('TOKEN is not defined!');
        // }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce     = $_GET["nonce"];

        // $token  = input('mp_weixin'); //['mp_weixin']; //'benweng';
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}
