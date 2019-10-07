<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\Csgoods;
use App\Weui\CsCate;
class ProlistController extends Controller
{
	// 产品 详情
    public function prolist(Request $request)
    {
    	$where = [];
    	// 分类
    	$cid = $request->input('cate_id');
    	
    	$is_sell = $request->input('is_sell');
    	if(!empty($is_sell)){
    		$where = ['is_sell'=>1];
    	}
		$cate = CsCate::all();
    	$cate = CsCate::createTree($cate,$cid);
    	$cateids = array_column($cate,'cate_id');
    	$ids = implode($cateids,',');
    	$goods = Csgoods::whereIn('cate_id',$cateids)->where($where)->get();
	return view('index.pro.prolist',['goods'=>$goods,'cateids'=>$ids,'is_sell'=>$is_sell]);
    }
    // ajax
    public function progoods(Request $request)
    {
    	//排序
    	$field = $request->input('field')??'goods_num';
	    $order = $request->input('order')??'desc';
        // 分类
        $cids = $request->input('cateids');
        $cids = explode(",",$cids);
        // 搜索
        $name = $request->input('name')??'';
        // dd($name);
        if (!empty($name)) {
           $where[] = ["cs_goods.goods_name","like","%".$name."%"];
           $goods = Csgoods::where($where)->orderBy($field,$order)->get();
        }
	  
	    if(!empty($cids)){
	    	$goods = Csgoods::whereIn('cate_id',$cids)->orderBy($field,$order)->get();
	    }
	    $is_sell = $request->input('is_sell');
	    if(!empty($is_sell)){
	    	$goods = Csgoods::where(['is_sell'=>$is_sell])->orderBy($field,$order)->get();
	    }
        // dd($goods);
    	return view('index/pro/div',['good'=>$goods]);
    }
}
