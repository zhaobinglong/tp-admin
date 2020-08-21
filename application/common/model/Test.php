<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26/026
 * Time: 下午 2:09
 */

namespace app\common\model;


use app\common\lib\utils\ArrayUtils;
use app\common\lib\utils\ModelUtils;

class Test extends BaseModel
{
    //预处理- 单图片
    public function checkImg($value){
        return ModelUtils::getUpdateImg($value);
    }
    //预处理- 多图片
    public function getTestAttr($value){
        return ModelUtils::getUpdateImages($value);
    }
    //预处理- 类型
    public function checkSelected($value){
        return ModelUtils::getInArrayValue(ArrayUtils::$complaintType,$value);
    }
    //预处理- 标题
    public function checkTitle($value){
        return ModelUtils::setTitleValue($value);
    }
    //预处理- 内容
    public function checkContent($value){
        return ModelUtils::setContentValue($value);
    }
}