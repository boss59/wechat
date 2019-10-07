<?php

namespace App\Weui;

use Illuminate\Database\Eloquent\Model;

class CsCate extends Model
{
    protected $table = 'cs_cate';// 表
   	protected $primaryKey = 'cate_id';// 主键
    // 定义常量时间
    const CREATED_AT = 'add_time';
	const UPDATED_AT = 'update_time';
	//  int类型 时间
	protected $dateFormat = 'U'; // U表示时间戳类型/
	protected $guarded = [];// 不可批量赋值的属性。 不加字段 可以通过
	// protected $fillable = [];
	// // 可批量赋值的属性。 要加字段  可以通过
	// 取消自动维护
	// public $timestamps = false;
	// 递归创建 分类 树形结构
    public static function createTree($data,$parent_id=0,$level=1)
    {
        //1 定义 一个容器（新数组);
        static  $new_arr = [];
        //2 遍历 数据一条条比对
        foreach ($data as $key => $value) {
            //3找 parent_id = 0 的id
            if ($value['parent_id'] == $parent_id) {
                //增加级别 字段
                $value['level'] = $level;
                //4 找到 之后放到新的数组里
                $new_arr[] = $value;
                //调用 程序自身递归找子集
                self::createTree($data,$value['cate_id'],$level+1);
            }
        }
        return $new_arr;
    }
    // 递归创建 分类 呈次结构
    public static function createTreeBySon($data,$parent_id=0)
    {
        //1 定义 一个容器（新数组);
        $new_arr = [];
        //2 遍历 数据一条条比对
        foreach ($data as $key => $value) {
            //3找 parent_id = 0 的id
            if ($value['parent_id'] == $parent_id) {
               $new_arr[$key] = $value;
               $new_arr[$key]['son'] = self::createTreeBySon($data,$value['cate_id']);
            }
        }
        return $new_arr;
    }
    public static function getCateId($data,$parent_id)
    {
        static $arr=[];
        $arr[$parent_id]=$parent_id;
        foreach ($data as $k => $v) {
            if ($v['parent_id']==$parent_id) {
                $arr[$v['cate_id']]=$v['cate_id'];
                self::getCateId($data,$v['cate_id']);
            }
        }
        return $arr;
    }
}
