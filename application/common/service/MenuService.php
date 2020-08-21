<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/10/010
 * Time: 下午 2:23
 */

namespace app\common\service;



class MenuService
{
    public function get() {
        $arr[] = $this->getIndex();
        $arr[] = $this->type();
        $arr[] = $this->hairstyle();
        $arr[] = $this->user();
        $arr[] = $this->config();
//        $arr[] = $this->test();
        return $arr;
    }
    //首页-类型 9
    protected function type(){
        $pid = 9;
        $controller = "Type";
        $action = "index";
        $subclass[]  = $this->getSubclass($pid,'类型管理',$controller,$action);
        $arr = [
            'id' => $pid,
            'name' => '类型',
            'fa' => 'fa fa-mixcloud',
            'controller' => $controller,
            'action' => $action,
            'href' => url($controller.'/'.$action),
            'subclass' => $subclass
        ];
        return $arr;
    }
    //首页-发型 10
    protected function hairstyle(){
        $pid = 10;
        $controller = "Hairstyle";
        $action = "index";
        $subclass[]  = $this->getSubclass($pid,'发型管理',$controller,$action);
        $arr = [
            'id' => $pid,
            'name' => '发型',
            'fa' => 'fa fa-gitlab',
            'controller' => $controller,
            'action' => $action,
            'href' => url($controller.'/'.$action),
            'subclass' => $subclass
        ];
        return $arr;
    }
    //首页-菜单
    protected function getIndex() {
        $pid = 1;
        $arr = [
            'id' => $pid,
            'name' => '概览',
            'fa' => 'fa fa-tachometer',
            'controller' => 'Index',
            'action' => 'index',
            'href' => url('index/index'),
            'subclass' => []
        ];
        return $arr;
    }
    //菜单-用户
    protected function test() {
        $pid = 8;
        $controller = "Test";
        $action = "index";
        $subclass[]  = $this->getSubclass($pid,'案例',$controller,$action);
//        $subclass[]  = $this->getSubclass($pid,'测试管理','Test2',$action,'hidden');
        $arr = [
            'id' => $pid,
            'name' => '测试',
            'fa' => 'fa fa-cog',
            'controller' => $controller,
            'action' => $action,
            'href' => url($controller.'/'.$action),
            'subclass' => $subclass
        ];
        return $arr;
    }
    //菜单-用户
    protected function config() {
        $pid = 5;
        $controller = "Config";
        $action = "index";
        $subclass[]  = $this->getSubclass($pid,'基础设置',$controller,$action);
        $subclass[]  = $this->getSubclass($pid,'微信设置',$controller,'wechat');
        $subclass[]  = $this->getSubclass($pid,'网页设置',$controller,'web');
        $subclass[]  = $this->getSubclass($pid,'秘钥设置',$controller,'score');
        $subclass[]  = $this->getSubclass($pid,'七牛云设置',$controller,"cloudSave");
        $arr = [
            'id' => $pid,
            'name' => '设置',
            'fa' => 'fa fa-cog',
            'controller' => $controller,
            'action' => $action,
            'href' => url($controller.'/'.$action),
            'subclass' => $subclass
        ];
        return $arr;
    }
    //菜单-用户
    protected function user() {
        $pid = 4;
        $controller = "User";
        $action = "index";
        $subclass[]  = $this->getSubclass($pid,'微信用户',$controller,$action);
        $arr = [
            'id' => $pid,
            'name' => '微信',
            'fa' => 'fa fa-wechat',
            'controller' => $controller,
            'action' => $action,
            'href' => url($controller.'/'.$action),
            'subclass' => $subclass
        ];
        return $arr;
    }
    //获取-》子分类
    protected function getSubclass($pid,$name,$controller,$action,$hidden = '') {
        $arr = [
            'pid' => $pid,
            'name' => $name,
            'controller' => $controller,
            'action' => $action,
            'href' => url($controller."/".$action),
            'hidden' => $hidden,
        ];
        return $arr;
    }
}