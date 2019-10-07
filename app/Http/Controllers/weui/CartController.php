<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\CsCary;
use App\Weui\Csgoods;
use App\Weui\Csbrand;
class CartController extends Controller
{
	// 购物车
    public function cart(Request $request)
    {
    	if ($request->session()->get('userinfo')) {
    		// 数据库
           $result=$this->listCaryDB();
        }else{
        	return view('index.pro.cart',['goods'=>'']);
        }
    	return view('index.pro.cart',['goods'=>$result]);
    }
    // 数据库 展示
    public function listCaryDB()
    {
        $where = [
            ["user_id",'=',session('userinfo')['user_id']],
        ];
        $caryModel = new CsCary;
        $Caryinfo = $caryModel
        ->where($where)
        ->join('cs_goods','cs_cary.goods_id','=','cs_goods.goods_id')
        // ->join('cs_goods','cs_brand.brand_id','=','cs_goods.brand_id')
        ->orderBy('cs_cary.add_time',"desc")
        ->get();
        if (!empty($Caryinfo)) {
            return $Caryinfo;
        }else{
            return false;
        }
    }

    // =================    列表操作 删除     ==========
    public function del(Request $request)
    {
        $goods_id=$request->input('goods_id');
        $where = [
            'user_id'=>session('userinfo')['user_id'],
            'goods_id'=>$goods_id,
        ];
        $cart  = CsCary::where($where)->delete();
        // dd($cart);
        if ($cart) {
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'删除失败','code'=>2]);
        }
    }
    public function alldel(Request $request)
    {
        $goods_id=$request->input('goods_id');
        $where = ['user_id'=>session('userinfo')['user_id']];
        $status  = CsCary::whereIn('goods_id',$goods_id)->where($where)->delete();
        // dd($status);
        if ($status) {
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'删除失败','code'=>2]);
        }
    }
    // 总价
    public function total(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $gid = explode(',',$goods_id);
        $user_id = session('userinfo')['user_id'];// 用户id
        $info = CsCary::where('user_id',$user_id)
        ->whereIn('cs_goods.goods_id',$gid)
        ->join('cs_goods','cs_cary.goods_id','=','cs_goods.goods_id')
        ->get();
        // dd($info);
        $count=number_format(0,2,'.','');
        foreach ($info as $k => $v) {
            $count+=$v['goods_price']*$v['buy_number'];
        }
        echo $count;
        // dump($goods_price); 
    }
}
