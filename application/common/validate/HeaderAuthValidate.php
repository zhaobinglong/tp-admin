<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/23/023
 * Time: 下午 4:44
 */

namespace app\common\validate;


class HeaderAuthValidate extends BaseValidate
{
    protected $rule =   [
        'nonceStr'  => 'require',
        'timeStamp'  => 'require',
        'noncestr'  => 'require',
        'timestamp'  => 'require',
        'data'  => 'require',
        'sign'  => 'require'
    ];

    protected $message  =   [
        'nonceStr.require'     => 'nonceStr不合法',
        'timeStamp.require'     => 'timeStamp不合法',
        'noncestr.require'     => 'nonceStr不合法',
        'timestamp.require'     => 'timeStamp不合法',
        'data.require'     => 'data不合法',
        'sign.require'     => 'sign不合法'
    ];

    protected $scene = [
        'sign'  =>  ['nonceStr','timeStamp','data','sign'],
        'header_sign'  =>  ['sign','noncestr','timestamp'],
    ];
}