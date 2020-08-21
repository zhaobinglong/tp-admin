<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12/012
 * Time: 下午 5:23
 */

namespace app\common\ModelService;


use app\common\model\WechatUser;

class WechatUserModel
{
    public static function model() {
        return new WechatUser();
    }
}