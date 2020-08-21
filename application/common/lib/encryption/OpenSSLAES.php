<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 15:57
 */
/**
 * 加密顶级父类
 */
namespace app\common\lib\encryption;
use app\common\ModelService\ConfigModel;

class OpenSSLAES
{
    /**
     * 默认秘钥
     */
    private $key = null;//16位
    /**向量
     * @var string
     */

    private  $iv = null;//16位

    private  $method="AES-128-CBC"; //模式
    //初始化
    public function __construct(){
        $config = ConfigModel::getEncryptSecret();
         $this->iv = $config['encrypt_id'];
         $this->key = $config['encrypt_secret'];
        //方案2 ， 定义一个，code进行字符串截取，，， 方案1是 找个16位字符串直接怼上去..
        // $code = md5($code);
        // $this->iv = substr($code,0,16);
        // $this->key = substr($code,16);
    }
    public static function create(){
        return new static();
    }
    /**
     * 加密字符串
     * @param string $data 字符串
     * @param string $key  加密key
     * @return string
     */
    public  function encrypt($string)
    {
        return base64_encode(openssl_encrypt($string,$this->method,$this->key,OPENSSL_RAW_DATA,$this->iv));
    }

    /**
     * 解密字符串
     * @param string $data 字符串
     * @param string $key  加密key
     * @return string
     */
    public  function decrypt($string)
    {
        return openssl_decrypt(base64_decode($string),$this->method,$this->key,OPENSSL_RAW_DATA,$this->iv);
    }
}
