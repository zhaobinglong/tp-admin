<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/5/23
 * Time: 22:03
 */

namespace app\admin\controller;


use app\common\lib\encryption\Md5;
use app\common\validate\AdminValidate;
use WeChat\Oauth;

class Index extends Base
{
    public function index() {
        return $this->fetch();
    }
    //修改密码
    public function user() {
        if(request()->isPost()){
            $data = input('post.');
            //验证器
            $validate = new AdminValidate();
            if(!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
            }
            $AdminData['username'] = $data['username'];
            //如果密码都存在的话
            if(!empty($data['password']) && !empty($data['password1'])){
                if($data['password']  != $data['password1']){
                    $this->error('两次密码输入不相同');
                }else{
                    $AdminData['password'] =  Md5::setEnPass($data['password']);
                }
            }elseif(!empty($data['password']) || !empty($data['password1'])){
                $this->error('密码不能为空');
            }
            db('admin')->where('id',$data['id'])->update($AdminData);
            session('user_id',null,'hammer_admin');
            $this->success('操作成功');
        }else{
            return $this->fetch();
        }
    }


}