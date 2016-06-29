<?php
namespace third;

class Yctest
{
    public function __construct($content)
    {

    }

    public static function sayHello($content)
    {
        $person = new Yctest('d');

        // call_user_func_array(array($person, 'talk'), array('hello'));
        $content = call_user_func(array($person, 'rm'), $content);
        return $content;
    }

    /**
     * 删除缓存
     * @access public
     * @param string $name 缓存变量名
     * @return boolean
     */
    public static function rm($content)
    {
        return '这是处理后的结果' . $content;
    }

}
