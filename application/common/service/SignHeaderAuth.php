<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/6/006
 * Time: 上午 9:30
 */

namespace app\common\service;


use app\common\lib\encryption\Md5;
use app\common\lib\encryption\OpenSSLAES;
use app\common\lib\exception\ApiException;
use app\common\lib\exception\SignException;
use app\common\ModelService\ConfigModel;
use app\common\validate\HeaderAuthValidate;
use think\facade\Cache;


class SignHeaderAuth
{
    /**
     * 数据验证
     * @param $data
     * @return bool
     * @throws SignException
     */
    public static function validate($data){
        $validate = new HeaderAuthValidate();
        if(!$validate->scene('header_sign')->check($data)){
            throw new SignException($validate->getError());
        }
        $sign = self::decrypt($data['sign']);
        $config = ConfigModel::getEncryptSecret();
        if($sign['nonceStr'] == $data['noncestr'] &&
            $sign['timeStamp'] == $data['timestamp'] &&
            $sign['encryptHeaderMd5'] == $config['encrypt_header_md5'])
        {
            //验证成功
        }else{
            throw new ApiException('sign签名不合法');
        }
        //验证是否请求超时
        if(time()-$sign['timeStamp'] > 10){
            throw new SignException('请求超时');
        }
        $md5 = Md5::setEnPass($data['sign']);
        $cacheMd5 = Cache::get($md5);
        if($cacheMd5){
            throw new SignException('禁止重复请求');
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
    protected static function decrypt($data){
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