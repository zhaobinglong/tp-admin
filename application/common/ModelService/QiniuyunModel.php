<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/10/010
 * Time: 下午 2:11
 */

namespace app\common\ModelService;


use app\common\service\QInIuService;

class QiniuyunModel
{
    //保存路径
    public  function savePath($value){
        //上传到七牛云
        $result = QInIuService::upload($value);
        $cloud_save_action = ConfigModel::model()->value('cloud_save_action');
        return [
            'key' =>  $result,
            'value' => $cloud_save_action."/".$result."?imageView2/0/q/75",
            'value1' => $cloud_save_action."/".$result."?imageView2/0/q/75"
        ];
    }
}