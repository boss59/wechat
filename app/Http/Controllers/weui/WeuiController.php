<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\Csgoods;
use App\Weui\CsCate;
use App\Weui\CsCary;
class WeuiController extends Controller
{
	// 首页
    public function index(Request $request)
    {
//        dd(session()->get('userinfo'));
    	// ==================商品===========
    	// 精选 推荐
    	$goodshow = Csgoods::where(['is_show'=>1])->get();
        $goodup = Csgoods::where(['is_up'=>1])->get();
        // 顶级的 分类
        $top_name = CsCate::where('parent_id',0)->first();
        // dd($top_name);
        $floor = $this->getFloot($top_name['cate_id']);
        // dd($floor);
    	return view('index.index',['goods'=>$floor['goods'],'top'=>$top_name,'goodup'=>$goodup,'goodshow'=>$goodshow]);
    }
    // 方法
    public function getFloot($cate_id)
    {
        //根据 大分类获取 商品
        // 先 获取 当前 大分类 下的 子分类
        $cate_data = CsCate::get();
        $cate_data = CsCate::createTree($cate_data,$cate_id);
        $cateids = array_column($cate_data,'cate_id');
        // dump($cateids);die;
        array_unshift($cateids,$cate_id);
        // dump($a);die;
        //获取 商品
        $goods = Csgoods::whereIn('cate_id',$cateids)->get();
        // dd($goods);
        // 组合数组
        return ['goods'=>$goods];
    }
    // ajax 楼层 数据显示
    public function ajaxgetFloor(Request $request)
    {
        $cate_id = $request->input('cate_id');

        $num = $request->input('num');
        $num = $num +1;

        // 条件
        $where = [
            ['parent_id','=',0],
            ['cate_id','>',$cate_id]
        ];
        // 获取 顶级分类
        $top_name = CsCate::where($where)->first();
        // dd($top_name['cate_id']);
        if (empty($top_name)) {
            echo 2;exit;
        }else{
            //调用 方法
            $floor = $this->getFloot($top_name['cate_id']);
            // dd($floor);
            return view('index.more',['num'=>$num,'goods'=>$floor['goods'],'top'=>$top_name]);
        }
    }
}
