<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/5/23
 * Time: 22:02
 */

namespace app\admin\controller;


use app\common\ModelService\ConfigModel;
use app\common\ModelService\ImagesModel;
use app\common\service\MenuService;

class Base extends Common
{
    protected  $admin_config = null;
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        //检测是否登录
        $this->isAdmin();
        //菜单加载
        $this->getMenu();
        //图片插件加载
        $this->assign('images',[]);
        $admin_config = ConfigModel::getAdminConfig();
        $this->assign('admin_config',$admin_config);
        $this->admin_config = $admin_config;
    }
    //是否登录
    protected function isAdmin() {
        //用户
        $user_id = session('user_id','','hammer_admin');
        if(empty($user_id)){
            $this->error('登录失效',url('login/loginOut'));
        }

        $admin  = db('admin')->where('id',$user_id)->find();
        if(empty($admin)){
            $this->error('登录失效',url('login/loginOut'));
        }
        $this->admin = $admin;
        $this->assign('admin',$admin);
    }
    //通用验证器
    protected function getValidate(TypeValidate $validate,$scene,$data) {
        if(!$validate->scene($scene)->check($data)){
            $this->error($validate->getError());
        }
    }
    //获取菜单
    protected function getMenu() {
        $api = new MenuService();
        $menu = $api->get();
        $controller = request()->controller();
        $action = request()->action();
        $subclass = [];
        $pid = 1;
        foreach($menu as $item){
            foreach($item['subclass'] as $key => $value) {
                if($value['controller'] == $controller && strtolower($value['action']) == $action){
                    $pid = $value['pid'];
                    $subclass = [
                        'index' => $key,
                        'name' => $item['name'],
                        'arr' => $item['subclass'],
                    ];
                    break;
                }elseif($value['controller'] == $controller){
                    $pid = $value['pid'];
                    $subclass = [
                        'index' => 9999,
                        'name' => $item['name'],
                        'arr' => $item['subclass'],
                    ];
                }
            }
        }
        $this->assign("menu",$menu);
        $this->assign("subclass",$subclass);
        $this->assign("pid",$pid);
    }
    //获取所有图片信息
    protected function getImages(){
        $images = $list = ImagesModel::all();
        $this->assign('images',$images);
    }

}