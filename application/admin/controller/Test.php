<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26/026
 * Time: 下午 1:19
 */

namespace app\admin\controller;


use app\common\ModelService\TestModel;

class Test extends Base
{
    //列表
    public function index(){
        $list = TestModel::model()->paginate();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //增加
    public function add(){
        $this->getImages();
        return $this->fetch();
    }
    //修改
    public function edit(){
        $this->getImages();
        $this->validateEdit(TestModel::model());
        return $this->fetch();
    }
    public function material(){
        return $this->fetch();
    }
}