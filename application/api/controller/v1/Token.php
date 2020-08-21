<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/28/028
 * Time: 下午 4:50
 */

namespace app\api\controller\v1;

use app\common\lib\utils\TokenUtils;
use app\common\model\WechatUser;
use app\common\service\TokenService;


class Token extends Base
{
    //获取token
    public function getToken() {
        $data = $this->getPost();
        //数据验证
        $service = new TokenService();

        $data = $service->get($data);
        return json_success($data);
    }
    //验证身份
    public function validateUser() {
        $user_id = TokenUtils::getCurrentUid();

        $user_info = (new WechatUser())->where('id',$user_id)->find();
        if(empty($user_info)){
            return json_error('用户不存在');
        }
        return json_success();
    }
}