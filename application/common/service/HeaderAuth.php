<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/23/023
 * Time: 下午 4:40
 */

namespace app\common\service;


use app\common\lib\encryption\OpenSSLAES;
use app\common\lib\utils\TimeUtils;

class HeaderAuth
{
    public static function checkSignPass($sign ='',$data = []) {
        $reSign = self::setSign($data);
        if($reSign !== $sign){
            return false;
        }
        return true;
    }
    public static function deSign($sign){
        $str = (new OpenSSLAES())->decrypt($sign);
        if(empty($str)){
            return false;
        }
        parse_str($str,$arr);
        if(empty($arr) || !is_array($arr)){
            return false;
        }
        return $arr;
    }
    public static function setSign($data = []) {
        //按照字典排序
        ksort($data);
        //拼接数据
        $string = http_build_query($data);
        //通过aes加密
        $aes = new OpenSSLAES();
        $string = $aes->encrypt($string);
        return $string;
    }
    public static function testAes(){
        $time = TimeUtils::get13Timestamp();
    }
}