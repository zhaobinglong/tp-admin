<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/21/021
 * Time: 下午 4:43
 */

namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;

    public function pdo_save($data) {
        $this->allowField(true)->save($data);
        return $this->id;
    }
    //通用增加点击率
    public function pdo_add_click($id) {
        $this->where('id',$id)->setInc('click');
        return true;
    }

    //通用修改
    public function pdo_edit($data,$whereData = []) {
        if(is_array($whereData)){
            $where = $whereData;
        }else{
            $where['id'] = $whereData;
        }
        return  $this->allowField(true)->save($data,$where);
    }

    public function pdo_get($data = []) {
        if(is_array($data)){
            $where = $data;
        }else{
            $where['id'] = $data;
        }
        return $this->where($where)->find();
    }
}