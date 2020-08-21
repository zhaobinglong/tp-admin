<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/15
 * Time: 12:47
 */

namespace app\admin\controller;


use app\common\lib\utils\SqlUtils;
use app\common\ModelService\TypeModel;

class Type extends Base
{
    public function index(){
        $where = SqlUtils::getWhereData(['name','type']);

        $types = TypeModel::model();
        if(!empty($where['type'])){
            $types = $types->where('pid',$where['type'])->whereOr('id',$where['type']);
        }
        $types = $types->order(SqlUtils::order())->select();

        $list = $this->_getSon($types);




        $pidList = TypeModel::model()->where('pid',0)->order(SqlUtils::order())->select();



        $this->assign('list',$list);
        $this->assign('where',$where);
        $this->assign('pidList',$pidList);
        $this->assign('types',$types);
        return $this->fetch();
    }
    // 根据父类id找所有子类
    protected function _getSon($data, $p_id=0, $level=0, $isClear=true){
        //声明一个静态数组存储结果
        static $res = array();
        //刚进入函数要清除上次调用此函数后留下的静态变量的值，进入深一层循环时则不要清除
        if($isClear==true) $res =array();
        foreach ($data as $v) {
            if($v['pid'] == $p_id){
                $v['level'] = $level;
                $res[] = $v;
                $this->_getSon($data, $v['id'], $level+1, $isClear=false);
            }
        }
        return $res;
    }
    public function add(){
        $types = TypeModel::model()->where('pid',0)->order(SqlUtils::order())->select();
        $type_pid = session('type_pid','','admin');
        $this->assign('types',$types);
        $this->assign('type_pid',empty($type_pid)?0:$type_pid);
        return $this->fetch();
    }
    public function edit(){
        $this->validateEdit(TypeModel::model());
        $types = TypeModel::model()->where('pid',0)->order(SqlUtils::order())->select();
        $this->assign('types',$types);
        return $this->fetch();
    }

    //通用修改或者添加
    public function save(){
        $pid = input('post.pid');
        session('type_pid',$pid,'admin');
        $this->common_save(url('index'));
    }
}