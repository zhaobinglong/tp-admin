<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/13/013
 * Time: 上午 8:58
 */

namespace app\common\service;


use app\common\ModelService\ConfigModel;
use EasyWeChat\Factory;

class WeChatService
{
    public static function app() {
        $config = self::config();
        return Factory::miniProgram($config);
    }

    protected static function config(){
        $model= ConfigModel::get();
        $config = [
            'app_id' => $model['appid'],
            'secret' => $model['app_secret'],
            'response_type' => 'array',
            'log' => [
                'level' => 'debug',
                'file' => __DIR__.'/wechat.log',
            ],
        ];
        return $config;
    }
    //以前的备份
    protected function cons(){

        $model= ConfigModel::get();
        $config = [
            'token'          => 'test',
            'appid'          => $model['appid'],
            'appsecret'      => $model['app_secret'],
            'encodingaeskey' => 'BJIUzE0gqlWy0qwewqewqGxfPp4J1oPTeqwewqBmOrNDIGPNavwqewqewq1YFH5Z5sadasdasdwqewq',
            'mch_id'         => "123546857046sdsad1102",
            'mch_key'        => 'IKI4kpHjU94ji3eqwoqewqere5zewqewqYaQMwLHuZPmjsdadsa',
            // 配置商户支付双向证书目录（可选，在使用退款|打款|红包时需要）
            'ssl_key'        => '',
            'ssl_cer'        => '',
            // 缓存目录配置（可选，需拥有读写权限）
            'cache_path'     => '',
        ];
        return $config;
    }
}