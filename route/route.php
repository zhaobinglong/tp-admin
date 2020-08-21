<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
//登录
Route::post('api/:v/get/token','api/:v.token/getToken');
//验证身份
Route::post('api/:v/validate/user','api/:v.token/validateUser');
//上传图片
Route::post('api/:v/upload/upImages','api/:v.upload/upImages');
//用户授权
Route::post('api/:v/setting/user','api/:v.User/setting');
//获取时间戳
Route::rule('api/:v/get/getTimeStamp','api/:v.time/getTimeStamp');



//首页
Route::get('api/:v/index/index','api/:v.index/index');
//获取列表
Route::get('api/:v/hairstyle/getPage','api/:v.hairstyle/getPage');
//获取详情页
Route::get('api/:v/hairstyle/details/:id','api/:v.hairstyle/details');




