<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/17
 * Time: 13:48
 */

namespace app\common\ModelService;


use app\common\model\Hairstyle;

class HairstyleModel
{
    public static function model(){
        return new Hairstyle();
    }
    public static function getCountByType($type = 0){
        if(empty($type)){
            return self::model()->count();
        }else{
            return self::model()->where('type',$type)->count();
        }
    }
}