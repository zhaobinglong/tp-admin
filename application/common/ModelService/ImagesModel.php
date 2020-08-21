<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/11/011
 * Time: 下午 5:03
 */

namespace app\common\ModelService;


use app\common\model\Images;

class ImagesModel
{
    public static function model() {
        return new Images();
    }

    public static function add($path) {
        $data = [
            'path' => $path,
        ];
        return self::model()->pdo_save($data);
    }
    public static function all() {
        return self::model()->order('id','desc')->select();
    }
}