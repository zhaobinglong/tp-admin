<?php

namespace app\common\lib\exception;

use app\common\ModelService\ErrorLogModel;
use Exception;
use think\exception\Handle;
use think\facade\Log;

/**
 *
 * 自定义API模块的错误显示
 * 适用于api形式的  异常处理器，
 * 开启
 *
 */
class ExceptionHandle extends Handle
{

    protected $httpCode=500;
    protected $code=500;
    protected $message='';
    public function render(\Exception $e)
    {

        //开启app_debug后交给程序处理
        $app_debug=config('app_debug');

        if ($e instanceof BaseException) {
            $this->httpCode=$e->httpCode;
            $this->code=$e->code;
        }else{
            //是否开启调试模式
            if($app_debug==true){
                return parent::render($e);
            }else{
                $this->code=500;
                $this->message="服务器内部错误";
                $this->httpCode=500;
            }
            ErrorLogModel::set($e->getMessage());
            $this->recordErrirLog($e);
        }

        return show($this->code,$e->getMessage(),[],$this->httpCode);
    }

    /**
     * 日志保存，保存错误日志
     * @param Exception $e
     *
     */
    private function recordErrirLog(\Exception $e){
        Log::init([
            "type"=>"File",
            "level"=>['error'],
        ]);
        Log::record($e->getMessage(),"error");


    }


}
