<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/18
 * Time: 15:53
 */

namespace app\api\controller\v1;


use app\common\ModelService\HairstyleModel;
use app\common\validate\IDValidate;

class Hairstyle extends Base
{
    //获取分页数据
    public function getPage(){
        $data = input();
        $page = $data['page'];
        $hairstyle_list = HairstyleModel::model();
        if(!empty($data['term'])){
            $hairstyle_list = $hairstyle_list->where("color_id",$data['term']);
        }
        if(!empty($data['term1'])){
            $hairstyle_list = $hairstyle_list->where("oiliness",$data['term1']);
        }
        if(!empty($data['term2'])){
            $hairstyle_list = $hairstyle_list->where("hardness",$data['term2']);
        }
        if(!empty($data['term3'])){
            $hairstyle_list = $hairstyle_list->where("smoothness",$data['term3']);
        }
        if(!empty($data['term4'])){
            $hairstyle_list = $hairstyle_list->where("shape",$data['term4']);
        }
        if(!empty($data['term5'])){
            $hairstyle_list = $hairstyle_list->where("hair_number",$data['term5']);
        }
        if(!empty($data['term6'])){
            $hairstyle_list = $hairstyle_list->where("body_mass",$data['term6']);
        }
        if(!empty($data['term7'])){
            $hairstyle_list = $hairstyle_list->where("length",$data['term7']);
        }

        if(!empty($data['type'])  && $data['type'] == 1){
            $hairstyle_list = $hairstyle_list->where("type",$data['type']);
            if(!empty($data['term8'])){
                $hairstyle_list = $hairstyle_list->where("damage",$data['term8']);
            }
            if(!empty($data['term9'])){
                $hairstyle_list = $hairstyle_list->where("coiling_degree",$data['term9']);
            }
            if(!empty($data['term10'])){
                $hairstyle_list = $hairstyle_list->where("coil_type",$data['term10']);
            }
        }elseif(!empty($data['type'])  && $data['type'] == 2){
            $hairstyle_list = $hairstyle_list->where("type",$data['type']);
//            if(!empty($data['term11'])){
//                $hairstyle_list = $hairstyle_list->where("background_color",$data['term11']);
//            }
        }

        if(!empty($data['search'])){
            $hairstyle_list = $hairstyle_list->where('effect_color|background_color|name','like',"%{$data['search']}%");
        }

        $strPage = ($page-1) * 12;
        $hairstyle_list= $hairstyle_list->where('status',1)
            ->order('id','desc')
            ->limit($strPage,12)->select();
        return json_success($hairstyle_list);
    }

    public function details($id){
        (new IDValidate())->goCheck();
        $info = HairstyleModel::model()->where('id',$id)->where('status',1)->find();
        if(empty($info)){
            return json_error('查询的发型不存在');
        }
        return json_success($info);
    }
}