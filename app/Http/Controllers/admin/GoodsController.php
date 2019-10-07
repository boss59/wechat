<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CsCate;
use App\Models\CsGoods;
use App\Models\CsBrand;
use Illuminate\Support\Facades\Storage;

class GoodsController extends Controller
{
    public function goodsadd(Request $request){
    	if($request->isMethod('POST')){
            $all = $request->except('_token');
             $all = $request->all();
            //文件上传
    		$path=Storage::putFile('goods_img',$request->file('goods_img'));
            // dd($path);
            $all['goods_img'] = $path;
            // 添加
      		
    		$res = CsGoods::create($all);
				if($res){
					return redirect("goods/goodslist");
				}
    		}

    	$data=CsCate::all();
    	$data=Cscate::getCateInfo($data);
   		$list=CsBrand::all();
    	return view('backend.goods.goodsadd',['data'=>$data,'list'=>$list]);

    }
    //商品展示
    public function goodslist(Request $request){
    	$list=\DB::table('Cs_Goods')
        ->join('cs_brand', function ($join) {
            $join->on('Cs_Goods.brand_id', '=', 'cs_brand.brand_id');
        })->join('Cs_Cate',function($join){
        	$join->on('Cs_Goods.cate_id','=','Cs_Cate.cate_id');
        })
        ->get();

        return view('backend.goods.goodslist',['list'=>$list]);
    }
    //删除
    public function goodsdel(Request $request){
    		$goods_id=request()->get('goods_id');
        $res=CsGoods::where('goods_id',$goods_id)->delete();
        if($res){
            return redirect()->back();
        }
    }
    //修改展示
    public function goodsupdate(Request $request){
    	$goods_id=request()->get('goods_id');
    	$goodsInfo=CsGoods::where('goods_id',$goods_id)->first();

    	$data=CsCate::all();
    	$data=Cscate::getCateInfo($data);
    	$list=CsBrand::all();
        return view('backend.goods.goodsupdate',['list'=>$list,'data'=>$data,'goodsInfo'=>$goodsInfo]);
    }
    //修改
    public function edit(Request $request){
    	$goods_id=request()->get('goods_id');
    	$data = $request->except('_token');
    	 $res=CsGoods::where('goods_id',$goods_id)->update($data);
            if($res){
                return redirect("/goods/goodslist");
            }
    }
}
