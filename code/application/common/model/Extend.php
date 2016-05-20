<?php
/**
 *
 *
 * @authors SpringYang
 * @email   ceroot@163.com
 * @date    2016-05-19 00:50:49
 * @site    http://www.benweng.com
 */
namespace app\common\model;

use think\Model;
use third\Data;

class Extend extends Model
{

    protected $insert = ['create_uid', 'create_ip'];
    protected $update = ['update_uid', 'update_ip'];

    // 取得全部数据并生成相应结构
    public function getAll($isArray = 0)
    {
        if ($isArray) {
            return Data::channelLevel($this->cache, 0, '', 'id', 'pid');
        } else {
            return Data::tree($this->cache, 'title', 'id', 'pid');
        }
    }
}
