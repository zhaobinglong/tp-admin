<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/25/025
 * Time: 下午 2:33
 */

namespace app\common\service;


use app\common\lib\encryption\Md5;
use app\common\lib\encryption\OpenSSLAES;
use app\common\lib\exception\ApiException;
use app\common\lib\exception\SignException;
use app\common\ModelService\ConfigModel;
use app\common\validate\HeaderAuthValidate;
use think\facade\Cache;

class SignAuth
{
    /**
     * 数据验证
     * @param $data
     * @return bool
     * @throws ApiException
     */
    public static function validate($data){
        $validate = new HeaderAuthValidate();
        if(!$validate->scene('sign')->check($data)){
            throw new ApiException($validate->getError());
        }
        $config = ConfigModel::getEncryptSecret();
        $sign = md5($data['nonceStr'].$config['encrypt_id'].$data['timeStamp'].$data['data'].$config['encrypt_md5']);
        if($sign != $data['sign']){
            throw new ApiException('sign签名不合法');
        }
        //验证是否请求超时
        if(time()-$data['timeStamp'] > 10){
            throw new ApiException('请求超时');
        }
        $md5 = Md5::setEnPass($data['sign']);
        $cacheMd5 = Cache::get($md5);
        if($cacheMd5){
            throw new ApiException('禁止重复请求');
        }
        Cache::set($md5,'1',10);
        return true;
    }

    /**
     * 解密data数据
     * @param $data
     * @return mixed
     * @throws SignException
     */
    public static function decrypt($data){
        $api = new OpenSSLAES();
        $result = $api->decrypt($data);
        if(empty($result)){
            throw new SignException('数据解析失败');
        }
        parse_str($result,$arr);
        if(empty($arr) || !is_array($arr)){
            throw new SignException('数据解析失败');
        }
        return $arr;
    }
}