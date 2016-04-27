<?php
namespace app\admin\controller;
use app\common\controller\Extend;

class Base extends Extend
{
    protected $model;

    public function _initialize(){
        
        // 定义UID
        define('UID',session('userid'));
        // dump(UID);


        if(!UID)
        {
            $this->redirect('admin/index/index');
        }

        $manager  = model('Manager')->get(UID);
        // dump($manager);
        // $user = User::get(1);
        // 锁定判断
        if($manager->status==1){
            $this->redirect('admin/index/index');
        }
        
        // model('AuthRule')->update_cache();
        // dump(cache('authrule'));
        // 生成不需要进行权限验证的和不需要实例化模型的控制器缓存
        if(!cache('auth_model')){
            model('AuthRule')->update_cache_auth_model();
        }

        // 读取不需要进行权限验证的和不需要实例化模型的控制器缓存
        $auth_model = cache('auth_model');
        


        if(ACTION_NAME)
        {
            $authName   = CONTROLLER_NAME.'/'.ACTION_NAME;
        }
        else
        {
            $authName   = CONTROLLER_NAME;
        }
        
        // 验证权限
        // 满足条件
        // 1 不是超级管理员
        // 2 是必须验证的
        if(!in_array(UID, config('auth_superadmin')) && !in_array($authName,$auth_model['not_auth'])){

            // 处理会员和管理员规则
            $controller = CONTROLLER_NAME;
            if($controller=='User' && I('role')==1)
            {
                $controller = 'manager';
            }
                
            // 权限验证
            $authName   = $controller . '/' . ACTION_NAME;
            // 执行验证
            if(!authCheck($authName,UID))
            {
                // 提示
                // $this->assign('message','您没有相关权限');
                // $this->display('./Data/Public/notice/auth.html');
                // return $this->error('您没有相关权限');
                // return $this->error('您没有相关权限');
                //return $this->error('您没有相关权限');
                echo '您没有相关权限';
                // $this->error('您没有相关权限');
                // return false;
                exit;
            }

        }

        define('CONTROLLER_ACTION',strtolower(CONTROLLER_NAME.'/'.ACTION_NAME));
        // 实例化模型
        $controllerName = CONTROLLER_NAME;
        
        // dump($auth_model['not_d_controller']);
        if(!in_array($controllerName,$auth_model['not_d_controller']))
        {
            // $this->model = D($controllerName);
            $this->model  = model($controllerName);
            // echo 1;
        }
        // echo 2;
        
        // die;

        // 菜单输出
        $menu  = model('AuthRule')->admin_menu();
        // dump($menu);
        // die;
        
        $this->assign('menu',$menu);



        // 管理员信息输出
        // $this->assign('manager',$manager);
// die;



        // $data['name']  = 'ThinkPHP';
        // $data['email'] = 'thinkphp@qq.com';
        // $data['sitename'] = 'YC';
        // $this->assign('data',$data);
    }



    
    public function yctest(){

        $dd  = S('auth_model');
        // dump($dd);
        //dump($ip);
    }


    
}

