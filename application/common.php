<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * api接口使用的
 * @param $status 【返回状态值】
 * @param string $message 【返回提示信息值】
 * @param array $data 【返回数据值】
 * @param int $httpCode 【http状态码】
 * @return \think\response\Json
 */
function show($status, $message = "", $data = [], $httpCode = 200)
{
    $showData = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return json($showData, $httpCode);
}
function json_success($data = [])
{
    $showData = [
        'status' => 1,
        'message' => 'success',
        'data' => $data,
    ];
    return $showData;
}
function json_error($message = 'error')
{
    $showData = [
        'status' => 0,
        'message' => $message,
        'data' => [],
    ];
    return $showData;
}

function json_show($status, $message = "", $data = [])
{
    $showData = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return $showData;
}

// 应用公共文件
//===============================================================================================公用函数




//===============================================================================================验证类函数


//===============================================================================================字符串函数


//================================================================================================图片上传的封装