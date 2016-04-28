<?php
/**
 * @filename  Action.php[用户行为控制器]
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-04-28 11:11:47
 * @site      http://www.benweng.com
 */
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;


class Action extends Base
{
	/**
	 * [_initialize 初始化]
	 * @return [type] [description]
	 */
	public function _initialize(){
        parent::_initialize();

	}

	public function log(){
        $list  = Db::name('actionLog')->select();
        $this->assign('list',$list);
		return $this->fetch();
	}
}