<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/19
 * Time: 17:26
 */

namespace app\common\lib\exception;


class ShowException extends BaseException
{
    //验证不通过
    public $message='无效请求';
    //验证不通过
    public $httpCode=400;

    public $code=404;

}