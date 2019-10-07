<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\CsCate;
class CateController extends Controller
{
    public function cate(Request $request)
    {
    	// 菜单
    	$nav = CsCate::where('parent_id',0)->get();
    	// dd($nav);
        // 商品分类
        $catData = CsCate::get();
        $list = CsCate::createTreeBySon($catData);
    	return view('index.cate',['nav'=>$nav,'list'=>$list]);
    }
}
