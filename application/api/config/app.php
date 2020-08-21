<?php

return [
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '\\app\\common\\lib\\exception\\ExceptionHandle',
    'app_debug'              => false,// Env::get('app.debug', false)
    // 应用Trace
    'app_trace'              => false,
    // 默认输出类型
    'default_return_type'    => 'json',
];
