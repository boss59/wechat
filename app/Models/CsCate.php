<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CsCate extends Model
{
   protected $table='Cs_Cate';
   protected $fillable=['cate_name','parent_id'];
   protected $primaryKey = 'cate_id';// 主键
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
