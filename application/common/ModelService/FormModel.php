<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15/015
 * Time: 上午 11:06
 */

namespace app\common\ModelService;


use app\common\model\Form;
use app\common\service\WeChatService;
use WeMini\Template;

class FormModel
{
    public static function model() {
        return new Form();
    }
    //保存form_id
    public static function save($form_id,$user_id) {
        if(empty($form_id) || empty($user_id)){
            return false;
        }
        if($form_id == "the formId is a mock one"){
            return false;
        }
        $data = [
            'form_id' => $form_id,
            'user_id' => $user_id,
        ];
        self::model()->pdo_save($data);
        return true;
    }
    //发送文章审核消息
    public static function sendArticleVerifyInfo($data){


        $config = ConfigModel::get();
        $api = new Template(WeChatService::config());

        $info = ArticleModel::model()->with("user")->where('id',$data['id'])->find();

        $form_id = self::validateFormID($info['user_id']);
        if(empty($form_id)){
            return false;
        }

        $data = [
            'touser' => $info['user']['openid'],
            'template_id' => $config['template_id'],
            'form_id' => $form_id,
            'page' => 'pages/integral/integral',
            'data' => [
                'keyword1'=>[
                    'value'=>$info['status']['key']==1?"您的申请已通过":"您的申请已驳回"
                ],
                'keyword2'=>[
                    'value'=>$data['score']
                ],
                'keyword3'=>[
                    'value'=>$info['user']['score_total']
                ],
                'keyword4'=>[
                    'value'=>date("Y-m-d H:i")
                ]
            ]
        ];


        try{
            $api->send($data);
        }catch (\Exception $e){

        }

        return true;
    }
    //发送消息
    public static function send($complaint,$status) {
        $str ="申诉成功";
        if($status == 3){
            $str ="申诉失败";
        }
        $config = ConfigModel::get();
        $user_id = $complaint['user_id'];
        $api = new Template(WeChatService::config());
        $user_info = WechatUserModel::model()->pdo_get($user_id);
        $form_id = self::validateFormID($user_id);
        if(empty($form_id)){
            return false;
        }
        $data = [
            'touser' => $user_info['openid'],
            'template_id' => $config['template_id'],
            'form_id' => $form_id,
            'page' => 'pages/login/login',
            'data' => [
                'keyword1'=>[
                    'value'=>$complaint['type_name']
                ],
                'keyword2'=>[
                    'value'=>$config['name']
                ],
                'keyword3'=>[
                    'value'=>$str
                ]
            ]
        ];
        $api->send($data);
        return true;
    }
    //检测form_id是否正常,并且获取一个正常的form_id
    public static function validateFormID($user_id) {
        $date = date("Y-m-d",time()-24*60*60*7);
        FormModel::model()->whereTime('create_time','<',$date)->select();
        $info = FormModel::model()->where('user_id',$user_id)->order('id','asc')->find();
        if(empty($info)){
            return false;
        }
        $form_id =$info['form_id'];
        FormModel::model()->where('id',$info['id'])->delete();
        return $form_id;
    }
}