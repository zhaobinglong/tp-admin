<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/17/017
 * Time: 上午 9:44
 */

namespace app\api\controller\v1;


use app\common\lib\utils\ArrayUtils;
use app\common\lib\utils\TokenUtils;
use app\common\ModelService\QiniuyunModel;

class Upload extends Base
{

    //上传图片
    public function upImages() {
        TokenUtils::getCurrentUid();
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        try{
            if(!empty($file)){
                $info = $file->validate(['ext'=>'jpg,png,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $day = date("Ymd");
                    $path ="uploads/".$day."/".$info->getFilename();
                    $api = new QiniuyunModel();
                    $result = $api->savePath($path);
                    return json_show(1,'success',$result);
                }
            }
        }catch (\Exception $e){
            return json_show(0,'图片只能上传jpg或者png图片不能上传动图');
        }

        return json_show(0,'图片只能上传jpg或者png图片不能上传动图');
    }
}