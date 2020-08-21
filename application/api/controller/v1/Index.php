<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12/012
 * Time: 下午 3:14
 */

namespace app\api\controller\v1;



use app\common\lib\encryption\OpenSSLAES;
use app\common\lib\utils\TokenUtils;
use app\common\ModelService\ConfigModel;
use app\common\ModelService\HairstyleModel;
use app\common\ModelService\TypeModel;
use app\common\ModelService\WechatUserModel;

class Index extends Base
{
    //获取首页数据
    public function index(){
        $type_list = (new TypeModel())->getTypeList();
        $hairstyle_list = HairstyleModel::model()->where('status',1)->order('id','desc')->limit(0,12)->select();
        $user_id = TokenUtils::getCurrentUid();
        $header = WechatUserModel::model()->where('id',$user_id)->value("header_img");
        $config_header = ConfigModel::model()->field("user_header")->find();
        $config_header = $config_header['user_header']['value'];

        $header = empty($header)?$config_header:$header;
        $arr = [
            'type_list' => $type_list,
            'hairstyle_list' => $hairstyle_list,
            'header' => $header,
            'config_header' => $config_header,
        ];
        return json_success($arr);
    }
}