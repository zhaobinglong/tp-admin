<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/4
 * Time: 16:17
 */

namespace app\common\lib\exception;


class ApiException extends BaseException
{
    //验证不通过
    public $message='系统错误';
    //验证不通过
    public $httpCode=500;

    public $code=500;
}