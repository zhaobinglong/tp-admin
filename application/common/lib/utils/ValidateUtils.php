<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/21/021
 * Time: 下午 4:54
 */

namespace app\common\lib\utils;


class ValidateUtils
{
    /**
     *  验证是否为正整数 （1-n）
     * @param $value
     * @return bool（success true    error false）
     */
    public static function isPositiveInteger($value){
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
            // return $field."必须是正整数";
        }
    }
    /**
     * 验证是否是数组类型
     * @param $arr
     * @return bool
     */
    public static function isPostArray($arr){
        if(empty($arr) || !is_array($arr)){
            return false;
        }
        return true;
    }
}