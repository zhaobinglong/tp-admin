<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/23/023
 * Time: 下午 4:07
 */

namespace app\common\ModelService;


use app\common\model\ErrorLog;

class ErrorLogModel
{
    public static function model() {
        return new ErrorLog();
    }
    public static function set($message){
        if(empty($message)){
            return false;
        }
        if(!is_string($message)){
            return false;
        }
        self::model()->save([
            'content' => $message
        ]);
        return true;
    }
}