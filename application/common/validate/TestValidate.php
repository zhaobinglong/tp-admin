<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26/026
 * Time: 下午 2:06
 */

namespace app\common\validate;


class TestValidate extends BaseValidate
{
    protected $rule =   [
        'test'  => 'require',
    ];

    protected $message  =   [
        'test.require'     => '多图上传不能为空，填上这一个就行了',
    ];

    protected $scene = [
        'edit'  =>  ['test'],
        'add'  =>  ['test'],
    ];
}