<?php
namespace app\index\controller;




use app\common\service\QInIuService;

class Index
{
    public function index()
    {

    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
    public function test(){
        return "你好";
    }

}