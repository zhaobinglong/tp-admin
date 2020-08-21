<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12/012
 * Time: 下午 4:44
 */

namespace app\common\validate;


class IDValidate extends BaseValidate
{
    protected $rule =   [
        'id'  => 'require|isPositiveInteger',
    ];
    protected $message  =   [
        'id.require'     => 'id不存在',
        'id.isPositiveInteger'     => 'id格式错误',
    ];
}