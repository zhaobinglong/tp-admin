<?php
namespace app\common\lib\utils;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 17:26
 */
class TimeUtils
{
    const TIME_STAMP_TYPE=1;//时间戳类型   int
    const DATE_TIME_TYPE=2;// 时间格式化类型  varchar  2018-10-27
    /*
    * 获取13位 的时间戳
    * **/
    public  static function  get13Timestamp(){

        list($t1,$t2)=explode(' ',microtime());
        return $t2.ceil($t1*1000);
    }
    public static function getTimeStampByWeb($time){
        $time = ceil($time/1000)+10;
        if(time() >=  $time){
            return false;
        }else{
            return true;
        }
    }

    /**
     *
     * @param $value
     * @return array
     */
    public static function getModelTime($value){
        return [
            'key'=>$value,
            'value'=>$value==0?$value:date("Y-m-d H:i",$value)
        ];
    }
    public static function setModelTime($value){
        if(empty($value)){
            return $value;
        }
        return strtotime($value);
    }
    /**
     * 检测更新时间是否超过一个月
     * @param $update_time
     * @return bool
     */
    public static function testingIsSave($update_time){
        //判断时间获取时间是否超过一个月，超过一个月更新信息
        $time=date("Y-m-d H:i:s",strtotime("last month"));//当前时间-1个月时间
        if($update_time<$time){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 检测是否超过7天
     * @param $update_time
     * @return bool
     */
    public  static function testingTokenIsSave($update_time){
        //判断时间获取时间是否超过一个月，超过一个月更新信息
        $day=ceil(config('app.token_expire')*0.6);
        $time=strtotime("+".$day." day");//当前时间-1个月时间
        if($update_time<$time){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 天转时间戳
     * @param $day
     * @return int
     */
    public static function getTimeStampByDay($day){
        $one_day=60*60*24;
        return $one_day*$day;
    }
    /**
     * 对时间进行格式化
     * @param $create_time (时间)
     * @param int $style  （1.时间戳，2字符串）
     * @return false|string
     */
   static function  getMessageTime($create_time,$style=self::TIME_STAMP_TYPE){
        //10分钟以内，显示刚刚
        //一天以内显示 创建 时:分
        //昨天的话  昨天 时:分
        $new_minutes=time();
        if($style==self::DATE_TIME_TYPE){
            $create_time=strtotime($create_time);
        }

        //十分钟前
        if($new_minutes<=$create_time+config("app.message_split_time")){
            return "刚刚";
        }

        //创建时间
        $creation_time=date("Y-m-d",$create_time);
        $current_time=date("Y-m-d");
        //昨天
        $one_day=date("Y-m-d",strtotime("-1 day"));

        if($creation_time==$current_time){
            return date("H:i",$create_time);
        }

        if($creation_time==$one_day){
            return "昨天 ".date("H:i",$create_time);
        }else{
            return date("m/d H:i",$create_time);
        }
    }

    static function getInitTime($time,$style=self::TIME_STAMP_TYPE){
        $new_minutes=time();
        if($style==self::DATE_TIME_TYPE){
            $create_time=strtotime($time);
        }else{
            $create_time=$time;
        }

        //十分钟前
        if($new_minutes<=$create_time+config("app.message_split_time")){
            return "刚刚";
        }

        //创建时间
        $creation_time=date("Y-m-d",$create_time);
        $current_time=date("Y-m-d");
        $py=$new_minutes-$time;

        //今天
        if($creation_time==$current_time){
            $str= date("h",$py);
            return $str."小时前";
        }else{
            $str=ceil($py/(60*60*24)-1);
            return $str."天前";
        }

    }
}