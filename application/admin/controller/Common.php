<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12/012
 * Time: 下午 2:07
 */

namespace app\admin\controller;


use app\common\model\BaseModel;
use think\Controller;

class Common extends SqlCommon
{
    //通用排序
    public function commonSort() {
        return $this->sqlStatusSort();
    }
    //通用修改状态
    public function setStatus() {
        return $this->sqlSetStatus();
    }
    //通用删除
    public function del() {
        return $this->sqlDel();
    }
    //通用假删除
    public function fakerDel() {
        return $this->sqlFakerDel();
    }
    //通用修改或者添加
    public function save(){
        $this->common_save(url('index'));
    }
    //通用验证修改信息
    protected function validateEdit(BaseModel $model) {
        $id = input('id');
        $info = $model->pdo_get($id);
        if(empty($info)){
            $this->error('信息不存在');
        }
        $this->assign('info',$info);
        return $info;
    }
}