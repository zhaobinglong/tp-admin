<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/25/025
 * Time: 上午 10:28
 */

namespace app\api\controller\v1;


class Time
{

    public function getTimeStamp() {
       $time = time();
       return json_success($time);
    }
}