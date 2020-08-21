<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26/026
 * Time: 下午 2:17
 */

namespace app\common\lib\utils;


use app\common\model\Config;
use app\common\ModelService\ConfigModel;

class UploadUtils
{
    //七牛云上传
    public static function getCloudSaveImg($value){
        $arr =  [
            'key' => $value,
            'value' => '/uploads/nopic.jpg',
            'value1' => request()->domain()."/uploads/nopic.jpg"
        ];
        if(empty($value)){
            return $arr;
        }
        $cloud_save_action = ConfigModel::model()->value('cloud_save_action');
        //获取七牛云上传的文件
        return [
            'key' =>  $value,
            'value' => $cloud_save_action."/".$value."?imageView2/0/q/75",
            'value1' => $cloud_save_action."/".$value."?imageView2/0/q/75"
        ];
    }
    //普通上传图片
    public static function getOrdinaryImg($value){
        $arr =  [
            'key' => $value,
            'value' => '/uploads/nopic.jpg',
            'value1' => request()->domain()."/uploads/nopic.jpg"
        ];
        if(empty($value)){
            return $arr;
        }
        //检测文件是否存在
        if(!file_exists($value)){
            return $arr;
        }
        $arr['value'] = "/".$value;
        $arr['value1'] = request()->domain()."/".$value;
        return $arr;
    }
}