<?php
/**
 * Created by PhpStorm.
 * User: 82042
 * Date: 2020/2/17
 * Time: 13:48
 */

namespace app\common\model;


use app\common\lib\utils\ArrayUtils;
use app\common\lib\utils\ModelUtils;
use app\common\ModelService\TypeModel;

class Hairstyle extends BaseModel
{
    protected  $type_list = array();
    public function __construct($data = [])
    {
        parent::__construct($data);
        $model = new TypeModel();
        $this->type_list = $model->getTypeList();
    }
    public function getTypeAttr($name){
        return ModelUtils::getInArrayValue(['不限','烫发','染发'],$name);
    }
    public function getColorIdAttr($name)
    {
       return ModelUtils::getInListArrayValue($this->type_list[0],$name);
    }
    public function getOilinessAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[1],$name);
    }
    public function getHardnessAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[2],$name);
    }
    public function getSmoothnessAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[3],$name);
    }
    public function getShapeAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[4],$name);
    }
    public function getHairNumberAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[5],$name);
    }
    public function getBodyMassAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[6],$name);
    }
    public function getLengthAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[7],$name);
    }
    public function getDamageAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[8],$name);
    }
    public function getCoilingDegreeAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[9],$name);
    }
    public function getCoilTypeAttr($name)
    {
        return ModelUtils::getInListArrayValue($this->type_list[10],$name);
    }
//    public function getBackgroundColorAttr($name)
//    {
//        return ModelUtils::getInListArrayValue($this->type_list[11],$name);
//    }
    public function getHeaderAttr($name)
    {
        return ModelUtils::getUpdateImg($name);
    }
    public function getImagesAttr($name)
    {
        return ModelUtils::getUpdateImages($name);
    }
    public function getContentAttr($name,$data)
    {
      $content = json_decode($name, true);
      if($data['type'] == 1){
          return $this->getPermData($content);
      }else{
          return $this->getDyeData($content);
      }
    }
    //获取染发信息
    protected function getDyeData($content){
        $data = [
            'effect_number' => $content['effect_number'],
            'background_color_number' => $content['background_color_number'],
            'color_number' => $content['color_number'],
            'color_number_value' => $content['color_number_value'],
            'proportion' => $content['proportion'],
            'oxidant' =>  ModelUtils::getInListArrayValue($this->type_list[27],$content['oxidant']),
            'dye_smear' => $content['dye_smear'],
            'dye_stop' => $content['dye_stop'],
            'dye_number' => $content['dye_number']
        ];
        return $data;
    }
    //获取烫发信息
    protected function getPermData($content){
        $data = [
            'smear' => ModelUtils::getInListArrayValue($this->type_list[12],$content['smear']),
            'stop' =>  ModelUtils::getInListArrayValue($this->type_list[14],$content['stop']),
            'apply_interval' =>  ModelUtils::getInListArrayValue($this->type_list[13],$content['apply_interval']),
            'touch' => ModelUtils::getInListArrayValue($this->type_list[15],$content['touch']),
            'elastic' =>  ModelUtils::getInListArrayValue($this->type_list[16],$content['elastic']),
            'water_temperature' =>  ModelUtils::getInListArrayValue($this->type_list[17],$content['water_temperature']),
            'duration' =>  ModelUtils::getInListArrayValue($this->type_list[18],$content['duration']),
            'tools' => ModelUtils::getInListArrayValue($this->type_list[19],$content['tools']),
            'water_content' =>  ModelUtils::getInListArrayValue($this->type_list[20],$content['water_content']),
            'angle' =>  ModelUtils::getInListArrayValue($this->type_list[21],$content['angle']),
            'tension' =>  ModelUtils::getInListArrayValue($this->type_list[22],$content['tension']),
            'technique' =>  ModelUtils::getInListArrayValue($this->type_list[23],$content['technique']),
            'temperature' =>  ModelUtils::getInListArrayValue($this->type_list[24],$content['temperature']),
            'constant_temperature' =>  ModelUtils::getInListArrayValue($this->type_list[25],$content['constant_temperature']),
            'heating_interval' =>  ModelUtils::getInListArrayValue($this->type_list[26],$content['heating_interval']),
        ];
        return $data;
    }
}