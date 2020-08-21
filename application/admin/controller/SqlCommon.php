<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14/014
 * Time: 上午 9:22
 */

namespace app\admin\controller;


use think\Controller;

class SqlCommon extends Controller
{
    //通用排序
    protected function sqlStatusSort($controller =null){
        if(!request()->isPost()){
            return json_show(1,'访问方式有误');
        }
        $id = input('id');
        $sort = input('sort');
        if(empty($controller)){
            $controller = request()->controller();
        }
        db($controller)->where('id',$id)->setField('sort',$sort);
        return json_show(0,'操作成功');
    }
    //通用修改状态
    protected function sqlSetStatus($controller =null) {
        if(!request()->isPost()){
            return json_show(1,'访问方式有误');
        }
        $id = input('id');
        $status = input('status');
        if(empty($controller)){
            $controller = request()->controller();
        }
        db($controller)->where('id',$id)->setField('status',$status);
        return json_show(0,'操作成功');
    }
    //通用删除
    public function sqlDel($controller =null) {
        $id = input('id');
        if(empty($controller)){
            $controller = request()->controller();
        }
        db($controller)->where('id',$id)->delete();
        return json_show(0,'删除成功');
    }
    //通用假删除
    public function sqlFakerDel($controller =null) {
        $id = input('id');
        if(empty($controller)){
            $controller = request()->controller();
        }
        db($controller)->where('id',$id)->setField('status',-1);
        return json_show(0,'删除成功');
    }
    //通用修改或者添加方法
    protected function common_save($success_url=null,$error_url=null,$controller = null) {
        $this->modifierSave($error_url,$controller);
        $this->success('操作成功',$success_url);
    }
    protected function modifierSave($error_url=null,$controller = null) {
        if(!request()->isPost()){
            $this->error('访问错误');
        }
        $post = input('post.');
        $str = 'add';
        if(!empty($post['id'])){
            $str = 'edit';
        }
        if(empty($controller)){
            $controller = request()->controller();
        }

        $validate = validate($controller.'Validate');
        if(!$validate->scene($str)->check($post)){
            $this->error($validate->getError(),$error_url);
        }

        if(!empty($post['id'])){
            model($controller)->allowField(true)->save($post,['id'=> $post['id']]);
        }else{
            model($controller)->allowField(true)->save($post);
        }
        return true;
    }
}