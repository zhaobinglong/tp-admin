<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/5/005
 * Time: 上午 9:11
 */

namespace app\common\validate;


class AdminValidate extends BaseValidate
{
    protected $rule =   [
        'id'   => 'require|isPositiveInteger',
        'username' => 'require',
        'password' => 'require',
    ];

    protected $message  =   [
        'id' => '[id]参数错误',
        'username' => '用户名不能为空',
        'password' => '密码不能为空',
    ];
    protected $scene = [
        'login'  =>  ['username','password'],
        'edit'  =>  ['id','username'],
    ];
}