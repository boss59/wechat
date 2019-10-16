<?php

namespace App\Weui;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resource';// 表
    protected $primaryKey = 'tid';// 主键
    // 定义常量时间
     const CREATED_AT = 'add_time';
    // const UPDATED_AT = 'update_time';
    //  int类型 时间
    // protected $dateFormat = 'U'; // U表示时间戳类型/
    protected $guarded = [];// 不可批量赋值的属性。 不加字段 可以通过
    // protected $fillable = ['pay_id','shipping_id','goods_amount','pay_status','order_status','shipping_status','zipcode','tel','email','best_time','sign_building','shipping_fee','user_id','order_sn','shipping_name','pay_name','add_time','confirm_time','pay_time','shipping_time','order_amount','consignee','mobile','province','city','district','address'];
    // protected $guarded = ['goods_id','address_id'];
    // // 可批量赋值的属性。 要加字段  可以通过
    // 取消自动维护
    public $timestamps = false;
}
