<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26/026
 * Time: 下午 2:24
 */

namespace app\common\ModelService;


use app\common\model\Test;

class TestModel
{
    public static function model(){
        return new Test();
    }
}