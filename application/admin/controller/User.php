<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/25/025
 * Time: 下午 4:01
 */

namespace app\admin\controller;


use app\common\lib\utils\SqlUtils;
use app\common\ModelService\WechatUserModel;
use think\db\Where;

class User extends Base
{
    public function index () {
        $post  = ['title'];
        $post = SqlUtils::getWhereData($post);
        $order['id'] = 'desc';
        $where = new Where();
        if(!empty($post['title'])){
            $where['nickname'] = ['like',"%{$post['title']}%"];
        }
        $list  = WechatUserModel::model()
            ->where($where)
            ->order($order)
            ->paginate(10,false,['query' => request()->param()]);
        $this->assign('list',$list);
        $this->assign('post',$post);
        return $this->fetch();
    }
}