<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26/026
 * Time: 下午 2:11
 */

namespace app\common\lib\utils;


class ModelUtils
{
    //排序
    public static function getOrder(){
        return [
            'sort' => 'desc',
            'id' => 'desc'
        ];
    }
    //获取select内容
    public static function getInArrayValue($array,$index){
        return [
            'key' => $index,
            'value' => isset($array[$index])?$array[$index]:'',
        ];
    }

    //获取select内容
    public static function getInListArrayValue($array,$value){
        $name = '';
        $index = 0;
        foreach($array['list'] as $key => $item){
            if($item['id'] == $value){
                $index = $key;
                $name = $item['name'];
                break;
            }
        }
        return [
            'key' => $index,
            'index' => $value,
            'value' =>$name
        ];
    }

    //获取上传文件路径
    public static function getUpdateImg($value) {
        return UploadUtils::getCloudSaveImg($value);
    }
    //获取多图
    public static function getUpdateImages($value) {
        if(empty($value)){
            return  [
                'key' => $value,
                'value' => [],
                'value1' => [],
            ];
        }
        $data  = [];
        $arr = explode(',',$value);
        foreach($arr as $item){
            $data[] = UploadUtils::getCloudSaveImg($item);
        }

        $result  = [
            'key' => $value,
            'value' => $data,
            'value1' => $data,
        ];
        return $result;
    }
    //获取标题
    public static function setTitleValue($value,$len=12) {
        $arr = [
            'key' => $value,
            'value' => $value,
        ];
        if(!empty($value)){
            $arr['value'] = StrUtils::interceptStr($value,0,$len);
        }
        return $arr;
    }
    //获取内容
    public static function setContentValue($value,$len=30) {
        $arr = [
            'key' => $value,
            'value' => $value
        ];
        if(!empty($value)){
            $arr['value'] = StrUtils::setContentStr($value,0,$len);
        }
        return $arr;
    }

}