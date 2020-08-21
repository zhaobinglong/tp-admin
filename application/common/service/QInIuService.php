<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/10/010
 * Time: 上午 11:08
 */

namespace app\common\service;


use app\common\ModelService\ConfigModel;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QInIuService
{
    public static function upload($filePath){
        $config = ConfigModel::getQInYun();
        $auth = new Auth($config['cloud_save_ak'], $config['cloud_save_sk']);
        $token = $auth->uploadToken($config['cloud_save_bucket']);
        // 上传到七牛后保存的文件名
        $key = md5($filePath);
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        $uploadMgr->putFile($token, $key, $filePath);
        return $key;
    }
}