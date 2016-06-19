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
}
