<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/29/029
 * Time: 下午 3:08
 */

namespace app\common\validate;


class UserValidate extends BaseValidate
{
    protected $rule =   [
        'id'  => 'require|isPositiveInteger',
    ];

    protected $message  =   [
        'id.require'     => 'id不存在',
        'id.isPositiveInteger'     => 'id格式错误',
    ];

    protected $scene = [
        'edit'  =>  ['id'],
    ];
}