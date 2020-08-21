<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/15
 * Time: 14:15
 */

namespace app\admin\controller;


use app\common\lib\utils\ModelUtils;
use app\common\lib\utils\SqlUtils;
use app\common\ModelService\HairstyleModel;
use app\common\ModelService\TypeModel;

class Hairstyle extends Base
{
    public function index(){
        $where = SqlUtils::getWhereData(['title','type','status']);

        $list = HairstyleModel::model();
        if(!empty($where['title'])){
            $list = $list->where('name','like',"%{$where['title']}%");
        }
        if(!empty($where['type'])){
            $list = $list->where('type',$where['type']);
        }
        if($where['status'] == 1){
            $list = $list->where('status',0);
        }elseif($where['status'] == 2){
            $list = $list->where('status',1);
        }

        $list = $list->order('id','desc')->paginate();

        $countData = [
            'count1' => HairstyleModel::getCountByType(),
            'count2' => HairstyleModel::getCountByType(1),
            'count3' => HairstyleModel::getCountByType(2),
        ];
        $this->assign('list',$list);
        $this->assign('where',$where);
        $this->assign('countData',$countData);
        return $this->fetch();
    }
    public function add(){
        $this->getImages();
        $model =  new TypeModel();
        $type_list = $model->getTypeList();
        $this->assign('type_list',$type_list);
        return $this->fetch();
    }
    public function edit(){
        $this->getImages();
        $this->validateEdit(HairstyleModel::model());
        $model =  new TypeModel();
        $type_list = $model->getTypeList();
        $this->assign('type_list',$type_list);
        return $this->fetch();
    }
    public function save(){
        $post = input("post.");

        $data = [
            'type' => $post['type'],
            'name' => $post['name'],
            'desc' => $post['desc'],
            'color_id' => $post['color_id'],
            'oiliness' => $post['oiliness'],
            'header' => $post['logo'],
            'images' => $post['test'],
            'hardness' => $post['hardness'],
            'smoothness' => $post['smoothness'],
            'shape' => $post['shape'],
            'hair_number' => $post['hair_number'],
            'body_mass' => $post['body_mass'],
            'length' => $post['length'],
        ];
        $content = [];
        if($post['type'] == 1){
            $data['damage'] = $post['damage'];//受损程度
            $data['coiling_degree'] = $post['coiling_degree'];//卷度
            $data['coil_type'] = $post['coil_type'];//卷型
            $content = [
                'smear' => $post['smear'],
                'stop' => $post['stop'],
                'apply_interval' => $post['apply_interval'],
                'touch' => $post['touch'],
                'elastic' => $post['elastic'],
                'water_temperature' => $post['water_temperature'],
                'duration' => $post['duration'],
                'tools' => $post['tools'],
                'water_content' => $post['water_content'],
                'angle' => $post['angle'],
                'tension' => $post['tension'],
                'technique' => $post['technique'],
                'temperature' => $post['temperature'],
                'constant_temperature' => $post['constant_temperature'],
                'heating_interval' => $post['heating_interval'],
            ];

        }elseif($post['type'] == 2){
            $data['background_color'] = $post['background_color'];//底色
            $data['effect_color'] = $post['effect_color'];//底色
            $content = [
                'effect_number' => $post['effect_number'],
                'background_color_number' => $post['background_color_number'],
                'color_number' => $post['color_number'],
                'color_number_value' => $post['color_number_value'],
                'proportion' => $post['proportion'],
                'oxidant' => $post['oxidant'],
                'dye_smear' => $post['dye_smear'],
                'dye_stop' => $post['dye_stop'],
                'dye_number' => $post['dye_number']
            ];
        }
        $data['content'] = json_encode($content);

        if(isset($post['id'])){
            HairstyleModel::model()->save($data,['id'=> $post['id']]);
        }else{
            $data['status'] = 1;
            HairstyleModel::model()->save($data);
        }

        $this->success('操作成功',url('index'));
    }
}