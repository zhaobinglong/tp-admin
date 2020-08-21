<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5
 * Time: 9:56
 */

namespace app\common\lib\exception;


class ValidateException extends BaseException
{
    //验证不通过
    public $message='无效请求';
    //验证不通过
    public $httpCode=200;

    public $code=10086;

}