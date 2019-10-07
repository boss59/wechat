<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CsGoods extends Model
{
     protected $table='Cs_Goods';
   protected $fillable=['goods_name','cate_id','brand_id','goods_price','goods_img','goods_num','goods_desc','is_show','is_new','is_sell','is_up'];
   protected $primaryKey = 'goods_id';// 主键
   public $timestamps = false;

   //公共函数
	//处理分类数据
	public static function getCateInfo($cateInfo,$parent_id=0,$level=0){
		static $info=[];//定义静态变量  只占一个空间
		foreach ($cateInfo as $k => $v){
			if($v['parent_id']==$parent_id){
				$v['level']=$level;
				$info[]=$v;
				self::getCateInfo($cateInfo,$v['cate_id'],$level+1);
				//自己调用自己
			}
		}
		return $info;
	}
}
