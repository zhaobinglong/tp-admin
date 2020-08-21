<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14/014
 * Time: 上午 9:04
 */

namespace app\admin\controller;


use app\common\lib\encryption\Md5;
use app\common\validate\AdminValidate;
use think\Controller;

class Login extends Controller
{
    //登录
    public function index() {
        $user_id = session('user_id','','hammer_admin');
        if(!empty($user_id)){
            $this->redirect(url('index/index'));
        }
        if(request()->isPost()){
            $data = input('post.');
            $validate = new AdminValidate();
            if(!$validate->scene('login')->check($data)){
                $this->error($validate->getError());
            }
            $info = db('admin')->where('username',$data['username'])->find();
            if(empty($info)) {
                $this->error('用户名错误');
            }
            if($info['password']!= Md5::setEnPass($data['password'])){
                $this->error('密码输入有误');
            }

            session('user_id',$info['id'],'hammer_admin');
            $this->success('登录成功',url('index/index'));
        }else{
            return $this->fetch();
        }
    }
    //退出登录
    public function loginOut() {
        session('user_id',null,'hammer_admin');
        $this->redirect(url('login/index'));
    }
}