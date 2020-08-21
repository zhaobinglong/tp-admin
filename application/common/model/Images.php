<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/11/011
 * Time: 下午 5:03
 */

namespace app\common\model;


use app\common\lib\utils\ModelUtils;

class Images extends BaseModel
{
    public function getPathAttr($value) {
       return  ModelUtils::getUpdateImg($value);
    }
}