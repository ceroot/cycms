<?php
namespace app\common\controller;
use think\Controller;

class Extend extends Controller
{
	
    public function verify()
    {
  
        $config = array(
            'codeSet'=>'0123456789',
            'length'=>4,
            'fontSize'=>14,
            'fontttf'=>'5.ttf'
        );
        $Verify = new \third\Verify($config);
        $Verify->entry();
    }
}