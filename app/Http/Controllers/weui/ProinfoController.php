<?php
namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\Csgoods;
use App\Weui\CsCary;
use App\Weui\Coller;
class ProinfoController extends Controller
{
	// 购物车 详情页
    public function proinfo(Request $request)
    {
    	$gid=$request->input('goods_id');
    	// 查询
    	$where = [
    		'goods_id'=>$gid,
    		'is_up'=>1
    	];
    	$goods = Csgoods::where($where)->first();
    	// 相册 
    	$goods->goods_imgs= explode('|',$goods['goods_imgs']);
        // dd($goods['goods_imgs']);
    	return view('index.pro.proinfo',['goods'=>$goods]);
    }
    // 加入 购物车
    public function addCary(Request $request)
    {
    	$data = $request->input();
    	// $user=$request->session()->get('userinfo'));
    	if ($request->session()->get('userinfo')['user_id']) {
    		// 数据库
          return $result=$this->addCaryDB($data);
        }else{

          return $result=['font'=>'请先登录','code'=>3];
        }
        echo json_encode($result);
    } 
    // 数据库 购物车
    public function addCaryDB($data)
    {
    	$user_id=$data['user_id']=session('userinfo')['user_id'];
        $where = [
        	'user_id'=>$user_id,
        	'goods_id'=>$data['goods_id'],
        ];
        $info = CsCary::where($where)->first();
        if (!empty($info)) {
        	// 验证库存
        	$result=$this->checkBuynumber($data['goods_id'],$data['buy_number'],$info['buy_number']);
            if (is_array($result)) {
                return $result;
            }


            // 更新时间 更新购买数量
            $info['buy_number'] += $data['buy_number'];
            $info['add_time'] = time();
            $res=CsCary::where($where)->update(['buy_number'=>$info['buy_number'],'add_time'=>$info['add_time']]);
            if ($res) {
                return ['font'=>'加入购物车成功','code'=>1];
            }else{
                return ['font'=>'加入购物车失败','code'=>2];
            }
        }else{
        	// 验证 库存
            $result=$this->checkBuynumber($data['goods_id'],$data['buy_number']);
            if (is_array($result)) {
                return $result;
            }
            $data['add_time'] = time();
            // 新增
            // dd($data);
            $res=CsCary::create($data);
            if ($res) {
                return ['font'=>'加入购物车成功','code'=>1];
            }else{
                return ['font'=>'加入购物车失败','code'=>2];
            }
        }
    }
    // 判断库存
   	public function checkBuynumber($goods_id,$buy_number,$aleray_number=0)
    {
        // echo $aleaay_number;die;
        // 根据 商品 id 查询 商品表 得到 库存
        $goods_number=Csgoods::where('goods_id',$goods_id)->value('goods_num');
        if (($buy_number + $aleray_number) > $goods_number) {
           return ['font'=>'库存不足,最多只能买'.($goods_number-$aleray_number).'件','code'=>2,'goods_number'=>$goods_number];
        }else{
            return true;
        }
    }
    //====================== 收藏 ======================
    public function coller(Request $request)
    {
    	$goods_id = $request->input('goods_id');
        $user_id = session('userinfo')['user_id'];
        if ($request->session()->get('userinfo')['user_id']) {
    		// 数据库
          return $result=$this->addcoller($goods_id,$user_id);
        }else{
          return $result=['font'=>'请先登录','code'=>3];
        }
        echo json_encode($result);
    }
    // 
    public function addcoller($goods_id,$user_id)
    {
    	$where = [
            'goods_id'=>$goods_id,
            'user_id'=>$user_id,
            'is_del'=>1,
        ];
        $info = Coller::where($where)->first();
        // dd($info);
        if (!empty($info)) {
            return ['font'=>'已收藏','code'=>1];die;
        }else{
        	$res = Coller::create($where);
	        if ($res) {
	            return ['font'=>'','code'=>2];die;
	        }else{
	            return ['font'=>'收藏失败','code'=>1];die;
	        }
        }   
    }
    // 
}
