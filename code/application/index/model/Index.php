<?php
namespace app\index\model;

use think\Model;

class Index extends Model
{
    public function geturl()
    {
        return url('indexUser');
    }
}
