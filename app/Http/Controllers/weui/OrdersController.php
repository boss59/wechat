<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\OrderInfo;
use App\Weui\OrderGoods;
use App\Weui\Csgoods;
class OrdersController extends Controller
{
	// 订单 管理
    public function orders(Request $request)
    {
    	// 全部
    	$count = '';
    	$user_id=session('userinfo')['user_id'];
		$order_info=OrderInfo::where("user_id",$user_id)->get()->toArray();
		$data=[];
		foreach ($order_info as $key => $value) {
			$data[$key]['order_id']=$value['order_id'];
			$data[$key]['pay_status']=$value['pay_status'];
			$data[$key]['order_sn']=$value['order_sn'];
			$data[$key]['order_amount']=$value['order_amount'];
			$info=OrderGoods::where(["order_id"=>$data[$key]['order_id'],"user_id"=>$user_id])->get()->toArray();
			$goods_id=[];
			foreach($info as $k=>$v){

				$goods_id[]=$v['goods_id'];
			}
			$count = Csgoods::whereIn("goods_id",$goods_id)->count();
			$data[$key]['shop_info']=Csgoods::join('order_goods','cs_goods.goods_id','=','order_goods.goods_id')
			->whereIn("order_goods.goods_id",$goods_id)
			->get(['cs_goods.goods_name',"cs_goods.goods_img","cs_goods.goods_price","cs_goods.goods_id","order_goods.buy_number"])
			->toArray();
		}
		// var_dump($data);exit;
    	// 待付款
    	$user_id=session('userinfo')['user_id'];
    	$where = [
    		'user_id'=>$user_id,
    		'pay_status'=>0
    	];
		$order_info=OrderInfo::where($where)->get()->toArray();
		$pay=[];
		foreach ($order_info as $key => $value) {
			$pay[$key]['order_id']=$value['order_id'];
			$pay[$key]['order_sn']=$value['order_sn'];
			$pay[$key]['order_amount']=$value['order_amount'];
			$info=OrderGoods::where(["order_id"=>$pay[$key]['order_id'],"user_id"=>$user_id])->get()->toArray();
			$goods_id=[];
			foreach($info as $k=>$v){

				$goods_id[]=$v['goods_id'];

			}
			$count = Csgoods::whereIn("goods_id",$goods_id)->count();
			$pay[$key]['shop_info']=Csgoods::join('order_goods','cs_goods.goods_id','=','order_goods.goods_id')
			->whereIn("order_goods.goods_id",$goods_id)
			->get(['cs_goods.goods_name',"cs_goods.goods_img","cs_goods.goods_price","cs_goods.goods_id","order_goods.buy_number"])
			->toArray();
		}
    	// 待发货
    	// 待收货
    	// 待评价
    	// dd($data);
    	return view('index.order.orders',['data'=>$data,'count'=>$count,'pay'=>$pay]);
    }
}
