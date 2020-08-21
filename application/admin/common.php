<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/2
 * Time: 17:02
 */


/**
 * 同步框框，用session进行操作
 * @param $name [查询的session名称]
 * @param $number  【查询的session值】
 * @return string
 */
function chimerNav($name,$number){
   $nav_session=session($name);
    if(empty($nav_session)){
        $nav_session=1;
    }
    if($nav_session==$number){
        return " active  ";
    }else{
        return "  ";
    }
}
/**
 * 同步框框，用session进行操作
 * @param $name [查询的session名称]
 * @param $number  【查询的session值】
 * @return string
 */
function chimerHide($name,$number){
    $nav_session=session($name);
    if(empty($nav_session)){
        $nav_session=1;
    }
    if($nav_session==$number){
        return "   ";
    }else{
        return ' style="display: none"   ';
    }
}

function getChecked($data,$index,$value){
    if(empty($data[$index])){
        if($value == 1){
            return "checked=''";
        }else{
            return " ";
        }
    }


    if($data[$index]['key'] == $value-1){
        return "checked=''";
    }else{
        return " ";
    }
}

function getInputValue($data,$index){
    if(empty($data[$index])){
        return "";
    }else{
        return $data[$index];
    }
}
/**
 * 数组转字符串
 * @param $arr
 * @return string
 */
function implodes($arr){
    return implode(',',$arr);
}