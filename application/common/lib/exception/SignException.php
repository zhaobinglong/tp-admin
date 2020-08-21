<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/6/006
 * Time: 上午 11:16
 */

namespace app\common\lib\exception;


class SignException  extends BaseException
{
    //验证不通过
    public $message='系统错误';
    //验证不通过
    public $httpCode = 40001;

    public $code = 40001;
}