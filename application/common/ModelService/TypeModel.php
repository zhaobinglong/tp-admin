<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/15
 * Time: 13:05
 */

namespace app\common\ModelService;


use app\common\model\Type;

class TypeModel
{
    public static function model(){
        return new Type();
    }
    public function getTypeList(){
        $list = TypeModel::model()->order("id",'aes')->select()->toArray();
        $list = $this->_getSon($list);
        $arr = [];
        $index = -1;
        foreach($list as $value){
            if($value['pid'] == 0){
                $index++;
                $arr[$index] = $value;
                $arr[$index]['list'] = [];
            }else{
                $arr[$index]['list'][] = $value;
            }
        }
        return $arr;
    }
    // 根据父类id找所有子类
    protected function _getSon($data, $p_id=0, $level=0, $isClear=true){
        //声明一个静态数组存储结果
        static $res = array();
        //刚进入函数要清除上次调用此函数后留下的静态变量的值，进入深一层循环时则不要清除
        if($isClear==true) $res =array();
        foreach ($data as $v) {
            if($v['pid'] == $p_id){
                $v['level'] = $level;
                $res[] = $v;
                $this->_getSon($data, $v['id'], $level+1, $isClear=false);
            }
        }
        return $res;
    }
}