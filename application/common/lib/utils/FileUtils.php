<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 14:24
 */

namespace app\common\lib\utils;


class FileUtils
{
    //文件读取
    //文件写入
    //文件上传处理
    //文件删除
    public static  function delete($fileName){
        if(empty($fileName)){
            return false;
        }
        if(file_exists($fileName)){
            unlink($fileName);
        }
    }
    public static function write($fileName,$content){
        $myFile=fopen($fileName,"a+");
        fwrite($myFile,$content);
    }
    public static function set($content,$type=1){
        if($type==2){
            $content=json_encode($content);
        }
        $content.="\r\n\r\n";
        $file="./static/test/xml.txt";
        self::write($file,$content);
    }
}