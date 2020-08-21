<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12/012
 * Time: 下午 5:22
 */

namespace app\common\lib\exception;


class CommonException extends BaseException
{
    //验证不通过
    public $message='通用错误';
    //验证不通过
    public $httpCode=500;

    public $code=500;
}