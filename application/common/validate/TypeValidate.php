<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/15
 * Time: 13:06
 */

namespace app\common\validate;


class TypeValidate extends BaseValidate
{
    protected $rule =   [
        'id'  => 'require|isPositiveInteger',
        'name'  => 'require',
    ];
    protected $message  =   [
        'id.require'     => 'id不存在',
        'name.require'     => '分类名称不能为空',
        'id.isPositiveInteger'     => 'id格式错误',
    ];
    protected $scene = [
        'edit'  =>  ['id','name'],
        'add'  =>  ['name'],
    ];
}