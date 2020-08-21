<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12/012
 * Time: 下午 2:42
 */

namespace app\common\ModelService;


use app\common\model\Config;

class ConfigModel
{
    public static function model() {
        return new Config();
    }

    public static function get() {
        $info = self::model()->find();
        if(empty($info)){
            self::model()->pdo_save(['name'=>'暂无']);
            $info = self::model()->find();
        }
        return $info;
    }
    public static function getEncryptSecret(){
        return self::model()->field('encrypt_id,encrypt_secret,encrypt_md5,encrypt_header_md5')->find();
    }
    public static function getAdminConfig(){
        return self::model()->field('name,logo,desc,key_word')->find();
    }
    public static function getQInYun(){
        return self::model()->field('cloud_save_ak,cloud_save_sk,cloud_save_action,cloud_save_bucket')->find();
    }
}