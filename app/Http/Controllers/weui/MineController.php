<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\Csgoods;
use App\Weui\Coller;
class MineController extends Controller
{
	// 我的
    public function mine(Request $request)
    {
    	$info = $request->session()->get('userinfo');
    	if ($request->session()->has('userinfo')) {
		    return view('index.mine.mine',["data"=>$info['phone']]);
		}else{
			return view('index.mine.mine',['data'=>'']);
		}
    }
    // 我的 收藏 展示
    public function mycoller(Request $request)
    {
        $user_id=$data['user_id']=session('userinfo')['user_id'];
        $where = [
            ['user_id','=',$user_id],
            ['is_up','=',1],
            ['is_del','=',1]
        ];
        $colectinfo = Coller::join('cs_goods','collect.goods_id','=','cs_goods.goods_id')
        ->where($where)
        ->orderBy('created_at',"desc")
        ->get();
        return view('index.mine.mycoller',['coller'=>$colectinfo]);
    }
    //退出登陆
    public function quit(Request $request)
    {
    	$res = $request->session()->flush();
    	return redirect("/weui/index");
    }
    // 我的小金库
    public function myburse()
    {
        return view('index.mine.myburse');
    }
    // 交易记录
    public function record()
    {
        return view('index.mine.record');
    }
    // 密码修改
    public function password()
    {
        return view('index.mine.password');
    }
    // 银行卡
    public function card()
    {
        return view('index.mine.card');
    }
    // 余额充值
    public function chongzhi()
    {
        return view('index.mine.chongzhi');
    }
    // 评价
    public function comment()
    {
        return view('index.mine.comment');
    }
    // 密码修改
    public function psd_chage()
    {
        return view('index.mine.psd_chage');
    }
    // 添加银行卡
    public function add_card()
    {
        return view('index.mine.add_card');
    }
}
