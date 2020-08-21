<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 21:32
 */

namespace app\common\lib\utils;


/**
 * 数组相关的服务层
 * Class ArrayService
 * @package app\common\service
 */
class ArrayUtils
{
    public static $articleStatus = [-1=>'已删除',0=>'审核中',1=>'审核通过',2=>'审核驳回'];
    public static $exchangeStatus = ['过期','正常'];
    public static $complaintStatus = ['未回复','已回复','已处理','已驳回'];
    public static $complaintType = ['保密','公开'];
}