<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/26/026
 * Time: 下午 2:42
 */

namespace app\api\controller\v1;


use app\common\lib\utils\TokenUtils;
use app\common\ModelService\WechatUserModel;

class User extends Base
{
    public function getUserInfo() {
        $user_id = TokenUtils::getCurrentUid();
        $info = WechatUserModel::model()->where('id',$user_id)->find();
        return json_success($info);
    }
    public function setting(){
        $post = $this->getPost();
        $user_id = TokenUtils::getCurrentUid();
        $userData  = [
            'nickname' => $post['nickname'],
            'header_img' => $post['header_img'],
        ];
        WechatUserModel::model()->save($userData,['id'=>$user_id]);
        return json_success();
    }
}