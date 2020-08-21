<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/28/028
 * Time: 下午 5:02
 */

namespace app\common\service;


use app\common\lib\exception\CommonException;
use app\common\lib\utils\StrUtils;
use app\common\model\WechatUser;

class TokenService
{
    protected  $data = null;
    public function get($data){
        $this->data = $data;
        return $this->login();
    }
    //登录并获取openid
    protected function login() {
        try{
            $result = WeChatService::app()->auth->session($this->data['code']);
        }catch (\Exception $e){
            throw new CommonException('小程序登录失败');
        }

        if(empty($result)){
            throw new CommonException('小程序登录失败');
        }
        $model  = new WechatUser();

        $user_info = $model->where('openid',$result['openid'])->find();

        if(empty($user_info)){
            $data = [
                'openid' => $result['openid'],
                'nickname' => isset($this->data['nickName'])?StrUtils::removeEmojiChar($this->data['nickName']):'',
                'header_img' => isset($this->data['avatarUrl'])?$this->data['avatarUrl']:'',
                'refresh_time'=>time()
            ];
            $model->save($data);
            $user_id = $model->id;
        }else{
            $time = 60*60*24*30;
            $refresh_time = $user_info['refresh_time']+$time;
            if($refresh_time > time()){
                $user_id = $user_info->id;
            }else{
                $user_id = $user_info->id;
                $user_info->nickname =  isset($this->data['nickName'])?StrUtils::removeEmojiChar($this->data['nickName']):'';
                $user_info->header_img =  isset($this->data['avatarUrl'])?$this->data['avatarUrl']:'';
                $user_info->refresh_time = time();
                $user_info->save();
            }
        }
        $token = $this->prepareCachedValue($user_id);
        return ['token'=>$token];
    }

    //注册
    protected function prepareCachedValue($uid){
        $cachedValue['user_id'] = $uid;
        $cachedValue['create_time'] = date("Y-m-d H:i:s");
        $cachedValue['no_str'] = StrUtils::getRandChars(16);
        $value=json_encode($cachedValue);
        $key = StrUtils::generateToken();
        $expire_in=config("setting.token_expire_in");
        cache($key, $value, $expire_in);
        return $key;
    }
}