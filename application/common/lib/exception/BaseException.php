<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/20
 * Time: 11:15
 */

namespace app\common\lib\exception;


use think\Exception;


class BaseException extends Exception
{
    public $message='';
    public $httpCode=500;
    public $code=500;
    public function __construct($message='', $code=0, $httpCode=0)
    {
        if(!empty($message)){
            $this->message=$message;
        }


        if(!empty($httpCode)){
            $this->httpCode=$httpCode;
        }
        if(!empty($code)){
            $this->code=$code;
        }
    }
}