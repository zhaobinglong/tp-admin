<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 11:22
 */

namespace app\common\lib\encryption;

use app\common\lib\exception\ApiException;
use app\common\lib\exception\ValidateException;

/**
 * 签名加密
 * Class Sign
 * @package app\common\lib\encryption
 */
class Sign
{

    /**
     * 小程序加密
     * @param $params [数组]
     * @return string
     * @throws ApiException
     */
    public static  function enData($params=[]){
        if(empty($params) || !is_array($params)){
            throw new ApiException('数据不合法');
        }
        try{
            $str=OpenSSLAES::create()->encrypt(json_encode($params));
        }catch(\Exception $e){
            throw new ApiException($e->getMessage());
        }
        return $str;
    }

    /**
     * 小程序数据解密
     * @param $params
     * @param bool $is_effect
     * @return mixed
     * @throws ApiException
     * @throws ValidateException
     */
    public  static function deData($params,$is_effect=false){
        $aes=new OpenSSLAES();
        /**
         * 数据解密
         */
        try{
            $str=$aes->decrypt($params);
        }catch(\Exception $e){
            throw new ApiException($e->getMessage());
        }

        /**
         * 做字符串对比,验证数据是否有变动过
         */
        if($is_effect==true){
            $sign=md5($str.'32');
            if($sign!=$params['sign']){
                throw new ValidateException('数据签名效验失败');
            }
        }

        $data=json_decode($str,true);
        return $data;
    }

    /**
     * 加密sign串
     * @param array $data
     * @return string
     */
    public static function enSign($data=[]){
        //1.加上数据盐
        $data['scope']= 32;
        //2. 按字典排序
        ksort($data);
        //3.字符串拼接 &
        $string=http_build_query($data);
        //4.所有字符转换成大写
//        $string=strtoupper($string);
        $string=OpenSSLAES::create()->encrypt($string);
        return $string;
    }

    /**
     * 解密sign串
     * @param $sign
     * @return bool|array
     */
    public static function deSign($sign){
        $str=OpenSSLAES::create()->decrypt($sign);
        if(empty($str)){
            return false;
        }
        parse_str($str,$arr);
        if(!is_array($arr)){
            return false;
        }
        return $arr;
    }

    /**
     * 验证通用sign的合法性
     * @param $sign
     * @return bool
     */
    public  static function  checkHeaderSignPass($sign){
        $arr=self::deSign($sign);

        if(!$arr){
            return false;
        }

        if(time()-ceil($arr['timestamp']/1000) > config('xcx.app_sign_time')){
            return false;
        }
        //请求唯一性.等小程序时，在进行测试
        $cache_sign=RedisUtils::redis()->get($sign);
        if($cache_sign){
            return false;
        }
        return true;
    }



}