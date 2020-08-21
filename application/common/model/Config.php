<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12/012
 * Time: 下午 2:42
 */

namespace app\common\model;


use app\common\lib\utils\ModelUtils;

class Config extends BaseModel
{
    public function getLogoAttr($value) {
        return ModelUtils::getUpdateImg($value);
    }
    public function getAcceptanceLogoAttr($value) {
        return ModelUtils::getUpdateImg($value);
    }
    public function getShareLogoAttr($value) {
        return ModelUtils::getUpdateImg($value);
    }
    public function getUserHeaderAttr($value) {
        return ModelUtils::getUpdateImg($value);
    }



}