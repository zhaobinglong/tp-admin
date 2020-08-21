<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 17:37
 */
return [
    'app_sign_time'=>10000,//过期时间10秒
    'app_sign_cache_time'=>20000,//redis缓存时间，保证请求的唯一性
    'token_expire'=>7,//小程序token保存时间
];