<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShopUser;
class UserController extends Controller
{
   // 添加
    public function useradd(Request $request)
    {
    	if($request->isMethod('POST')){
			$all = $request->all();
			// dd($all);die;
			$res = ShopUser::create($all);
			// dd($res);
			if($res){
				return redirect("/backend/userlist");
			}
			return redirect()->back();
		}
    	return view("backend.users.useradd");
    }
    // 查询
    public function userlist(Request $request)
    {
    	$where = [];
		$query = $request->input();
		// name
		if (!empty($request->input('name'))) {
			$where [] = ['shop_user.name','like',"%".$request->input('name')."%"];
		}
		// age
		if (!empty($request->input('age'))) {
			$where [] = ['shop_user.age','=',$request->input('age')];
		}
		// sex
		if (!empty($request->input('sex'))) {
			$where [] = ['shop_user.sex','=',$request->input('sex')];
		}
		// 排序
		$field = $request->input('field')??'user_id';
    	$order = $request->input('order')??'desc';
    	$data = ShopUser::where($where)->orderBy($field,$order)->paginate(3);
    	// $res = ShopUser::first()->toarray();
    	// dd($res);
    	// dd($data);die;
    	return view("/backend/users/userlist",compact('data','query'));
    }
    // 删除
    public function userdelete(Request $request)
    {
    	$user_id = $request->all();
    	// dd($user_id);
    	$where = [
    		'user_id'=>$user_id
    	];
    	$res = ShopUser::where($where)->delete();
    	if ($res) {
    		return redirect("/backend/userlist");
    	}
    	return redirect()->back();
    }
    // 修改
    public function userupdate(Request $request)
    {
    	$user_id = $request->get('user_id');
    	// dd($user_id);
    	$where = [
    		'user_id'=>$user_id
    	];
    	if($request->isMethod('POST')){
			$all = $request->except('_token');
			$res = ShopUser::where($where)->update($all);
			if($res){
				return redirect("/admin/userlist");
			}
			return redirect()->back();
		}
    	$info = ShopUser::where($where)->first();
    	return view("admin.users.userupdate",['info'=>$info]);
    }
    // 批删
    public function userdata(Request $request)
    {
    	$all = $request->all();
    	$user_id = explode(',',$all['user_id']);
		$res = ShopUser::whereIn('user_id',$user_id)->delete();
    	if ($res) {
    		echo json_encode(['code'=>1,'font'=>'删除成功']);
    	}else{
    		echo json_encode(['code'=>0,'font'=>'失败']);
    	}
    }

    // session
    public function  session(Request $request)
    {
        // 设置 session 
        $data = [
            'name'=>'一叶之秋',
            'pwd'=>md5(123),
        ];
        // 一维数组
        session()->put('key',["info"=>'ass']); // 一维数组
        // session()->put(['key'=>['shan'=>"ass"]]); 二维数组
        
        // 插入
        // session()->push('key.data','');

        // 闪存
        // $request->session()->flash('status', 'Task was successful!');

        // 保留请求
        // session()->reflash();
        // session()->keep(['username', 'email']);
        
        // 删除 session
        // session()->flush();// 删除所有
        // session()->pull('key');// 删除单条

        
    }
    public function test(Request $request)
    {
        // 获取 值
        // $data = session()->get('info');// 获取单个
        $data = session()->all();// 获取所有
        // dd($data);
        // 判断是否登录
        if ($request->session()->has('key')) {
           // 登录
        }else{
            // 未登录
        }
    }   
}
