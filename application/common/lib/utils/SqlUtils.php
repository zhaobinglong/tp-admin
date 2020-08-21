<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/15
 * Time: 13:27
 */

namespace app\common\lib\utils;


class SqlUtils
{
    public static function order(){
        $arr = [
            'sort' => 'desc',
            'id' => 'desc',
        ];
        return $arr;
    }
    /**
     * 传递数组类型,
     * @param $arr
     * @return array
     */
    public static function getWhereData($arr){
        $where=[];
        foreach($arr as $value){
            $where[$value]=input($value);
        }

        return $where;
    }
}