<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29/029
 * Time: 上午 10:05
 */

namespace app\common\lib\utils;


use app\common\lib\exception\CommonException;

class TokenUtils
{
    //获取header中的token，没有的话包异常
    public static function getCurrentTokenVar($key){
        //token
        $token=request()->header("token");

        if(empty($token)){
            throw new CommonException('登录失效,正在重新登录...',40001);
        }

        $vars =cache($token);
        if(!$vars)
        {
            throw new CommonException('登录失效,正在重新登录...',40001);
        }
        else
        {

            if(!is_array($vars))
            {
                $vars=json_decode($vars,true);
            }

            if(array_key_exists($key,$vars)){

                return $vars[$key];
            }else{
                throw new CommonException('尝试获取的Token变量不存在',40001);
            }
        }


    }

    public static function getCurrentUid(){
        //token
        $uid=self::getCurrentTokenVar('user_id');

        return $uid;
    }

}