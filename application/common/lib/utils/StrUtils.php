<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 15:22
 */

namespace app\common\lib\utils;

/**
 * 字符串操作
 * Class StrService
 * @package app\common\service
 */
class StrUtils
{
    //清除字符串中的 表情标签
    public static function removeEmojiChar($str)
    {
        $mbLen = mb_strlen($str);
        $strArr = [];
        for ($i = 0; $i < $mbLen; $i++) {
            $mbSubstr = mb_substr($str, $i, 1, 'utf-8');
            if (strlen($mbSubstr) >= 4) {
                continue;
            }
            $strArr[] = $mbSubstr;
        }
        return implode('', $strArr);
    }

    /**
     * 设置登录的token （唯一性的）
     * @param string $phone
     * @return string
     */
    public static function setAppLoginToken($phone=''){
        $str=md5(uniqid(md5(microtime(true)),true));
        $str=sha1($str.$phone);
        return $str;
    }

    /**
     * 生成随机的订单号
     */
    public static function getOrder(){
        $day=date("YmdHis");
        return $day.rand(100000,999999);
    }

    /**
     * 获取自定义长度的随机字符串
     * @param $length 【长度】
     * @return null|string 【返回字符串】
     */
    public static function getRandChars($length=16){
        $str=null;
        $strPol="QWERTYUIOPASDFGHJKLZXCVBNM1234567890zxcvbnmasdfghjklqwertyuiop";
        $max=strlen($strPol)-1;
        for($i=0;$i<$length;$i++)
        {
            $str.=$strPol[rand(0,$max)];
        }

        return $str;
    }
    //截取未处理的字符串
    public static function setContentStr($content,$start=0,$length=13,$type=false) {

        $content = strip_tags($content);
        $content = str_replace('&nbsp;', '', $content);
        $str = self::interceptStr($content,$start,$length,$type);
        return $str;
    }

    //获取token
    public static function generateToken()
    {
        //32个字符一组随机字符串
        $randChars = self::getRandChars(32);
        //用三组字符串，进行MD5加密
        $timestamp = $_SERVER["REQUEST_TIME_FLOAT"];
        //salt 盐
        $salt = config("secure.token_salt");

        return md5($randChars . $timestamp . $salt);
    }


    /**
     * 截取中文字符串
     * @param $content 【要截取的字符串】
     * @param int $start  【开始】
     * @param int $length  【截取长度】
     * @param bool $type  【字符串】
     * @return string  【字符串】
     */
    public static function interceptStr($content,$start=0,$length=13,$type=false){
        $mb_length=mb_strlen($content,"utf-8");
        if($mb_length>$length){
            if(empty($type)){
                $content=mb_substr($content,$start,$length,"utf-8")."...";
            }else{
                $content=mb_substr($content,$start,$length,"utf-8");
            }

        }
        return $content;
    }
    /**
     * 把序列化类型-》转数组后-》转成   1,2,3格式
     * @param $str
     * @return string
     */
    public static function getImplodeStr($str){
        $arr=unserialize($str);
        return $str=implode(",",$arr);
    }

    /**
     * 删除不存在的数组参数
     * @param $key
     * @param $arr
     * @return mixed
     */
    public static function deleteArrayValue($key,$arr){
        if(isset($arr[$key])){
            if(empty($arr[$key])){
                unset($arr[$key]);
            }
        }
        return $arr;
    }

}