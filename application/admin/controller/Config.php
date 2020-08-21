<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/25/025
 * Time: 下午 2:39
 */

namespace app\admin\controller;


use app\common\lib\utils\ArrayUtils;
use app\common\ModelService\ConfigModel;

class Config extends Base
{
    public function index() {
        $info = ConfigModel::get();
        $this->getImages();
        $this->assign('info',$info);
        return $this->fetch();
    }
    public function web() {
        if(request()->isPost()){
            $this->common_save(url('web'));
        }else{
            $info = ConfigModel::get();
            $this->getImages();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function wechat() {
        if(request()->isPost()){
            $this->common_save(url('wechat'));
        }else{
            $info = ConfigModel::get();
            $this->getImages();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function score(){
        if(request()->isPost()){
            $this->common_save(url('score'));
        }else{
            $info = ConfigModel::get();
            $this->getImages();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function cloudSave(){
        if(request()->isPost()){
            $this->common_save(url('cloudSave'));
        }else{
            $info = ConfigModel::get();
            $this->getImages();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
}