<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/23/023
 * Time: 下午 4:24
 */

namespace app\common\lib\encryption;


use app\common\lib\utils\StrUtils;

class Md5
{
    /**
     * 通用设置不可逆但是可以进行验证的密码或者token
     * @param $value
     * @param string $str
     * @return string
     */
    public static function setEnPass($value,$str='manager'){
        return sha1(md5(md5($value)).$str);
    }

    /**
     * 加密token方法1,设置不可逆不重复的头肯令牌
     * 设置登录的token （唯一性的）
     * @return string
     */
    public static function setToken(){
        //32个字符一组随机字符串
        $randChars=StrUtils::getRandChars(32);
        //用三组字符串，进行MD5加密
        $timestamp=$_SERVER["REQUEST_TIME_FLOAT"];
        //salt 盐
        $salt=config("app.token_salt");
        return md5($randChars.$timestamp.$salt);
    }

    /**
     * 加密token方法2,设置不可逆不重复的头肯令牌
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
     * 获取加密不可逆的数据签名
     * @param array $data
     * @return string
     */
    public  static function getDataSign($data=[]){
        //1.加上数据盐
        $data['scope']= 32;
        //2. 按字典排序
        ksort($data);
        //3.字符串拼接 &
        $string=http_build_query($data);
        //4.所有字符转换成大写
        $string=strtoupper($string);
        //5.通过 md5 进行加密
        $string=md5(md5($string));
        return $string;
    }

}