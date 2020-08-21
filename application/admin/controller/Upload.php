<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/11/011
 * Time: 下午 1:50
 */

namespace app\admin\controller;




use app\common\lib\utils\FileUtils;
use app\common\ModelService\ImagesModel;
use app\common\ModelService\QiniuyunModel;

class Upload extends Base
{
    public function upImage() {
        // 获取表单上传文件 例如上传了001.jpg
        try{
            $files = request()->file('file');
        }catch (\Exception $e){
            $message = $e->getMessage();
            if($message == "upload File size exceeds the maximum value"){
                $message ="上载文件大小超过最大值";
            }
            return json_show(0,$message);
        }
        if($files){
            $arr = [];
            foreach($files as $file){
                // 移动到框架应用根目录/uploads/ 目录下
                $info = $file->move( 'uploads/');
                if($info){
                    $day = date("Ymd");
                    $path ="uploads/".$day."/".$info->getFilename();
                    $api = new QiniuyunModel();
                    $result = $api->savePath($path);
                    //删除原图
                    unset($info);
                    FileUtils::delete($path);

                    $id = ImagesModel::add($result['key']);
                    $arr[]  = [
                        'id' => $id,
                        'path' => $result
                    ];
                }
            }
            return json_show(1,'success',$arr);
        }

        return json_show(0,'error');
    }

    //图片删除
    public function delImg() {
        $data = input('post.');
        if(empty($data['arr'])){
            return json_show(0,'请选择要删除的图片');
        }
        //删除选中图片
        ImagesModel::model()->where('id','in',$data['arr'])->delete();
        $list = ImagesModel::all();

        return json_show(1,'success',$list);
    }
}