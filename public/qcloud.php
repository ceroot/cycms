<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require('./include.php');

use Qcloud_cos\Auth;
use Qcloud_cos\Cosapi;

$bucketName = 'bing';

//Cosapi::setTimeout(10);

$year	= date('Y');	// 年
$month	= date('m');	// 月
$path     = '/'.$year.$month;

//$path  = '/201603';
//statFolder
$statRet = Cosapi::statFolder($bucketName, $path);

if($statRet['code']!=0){
    //创建目录
    $createFolderRet = Cosapi::createFolder($bucketName, $path);
    var_dump($createFolderRet);
}
die;

// 上传文件
$srcPath  = './201602230102.jpg';
$dstPath  = $path.'/201602230102.jpg';

$uploadRet = Cosapi::upload($srcPath, $bucketName, $dstPath);
var_dump($uploadRet);

