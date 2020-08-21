<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/13
 * Time: 21:37
 */

namespace app\common\validate;

use app\common\lib\encryption\Sign;
use app\common\lib\exception\ValidateException;
use think\Validate;

class BaseValidate extends Validate
{
    /**
     * @param string $scene （场景值 ）
     * @param bool $type     （返回错误类型，） false=412【提示信息直接跳转重新登录】  true=400【提示信息，不进行跳转页面】
     * @param bool $is_decrypt （是否对数据进行解密）
     * @param bool $is_effect   （是否对数据进行严格效验）
     * @return mixed
     * @throws ValidateException
     */
    public function goCheck($scene=null,$type=true,$is_decrypt = false,$is_effect=false){
        //获得所有的post，get的参数
        $params=request()->param();
        if ($is_decrypt == true) {
            $params=Sign::deData($params['encryption'],$is_effect);
        }


        //验证
        if(empty($scene)){
            $result=$this->batch()->check($params);
        }else{
            $result=$this->scene($scene)->batch()->check($params);
        }
        //如果不通过
        if(!$result){
            $result=$this->getError();
            $str = "";
           foreach($result as $value){
               $str = $value;
               break;
           }

            if(empty($type)){
                throw new ValidateException($str);
            }else{
                throw new ValidateException($str);
            }
        }else{
            return $params;
        }
    }

    //验证是否是正整数
    protected function isPositiveInteger($value, $rule = "", $data = "", $field = "")
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
            // return $field."必须是正整数";
        }
    }

    /*验证是否是空值*/
    protected function isNotEmty($value,$rule="",$data="",$field=""){
        if(empty($value))
        {
            return false;
        }else
        {
            return true;
        }
    }
    //验证是否是手机号
    protected function isPhone($value,$rule="",$data="",$field=""){
        $preg_phone='/^1[34578]\d{9}$/ims';
        if(preg_match($preg_phone,$value)){
            return true;
        }else{
            return false;
        }
    }
}