<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    // 注销
    public function quit(Request $request)
    {
        // 退出 登陆
        Auth::guard()->logout();
        // 跳转 地址 登陆
        return redirect('/login');
    }




































    	// 注册
   //  public function regist(Request $request)
   //  {
   //  	if ($request->isMethod('post')) {
   //  		$all = $request->except('_token');
   //  		// 验证
   //  		$validator = Validator::make($all, [
   //              'user_name' => 'required|unique:shop_register|max:10',
   //              'user_pwd' => 'required',
   //           ],[
   //               'user_name.required' => '名称不能为空',
   //               'user_name.unique' => '名称已存在',
   //               'user_name.max' => '字段最大姓名为10位',
   //               // 密码
   //               'user_pwd.required' => '密码不能为空',
   //               'user_pwd.max' => '密码不能超过6位',
   //               // 确认密码
   //               'pwds.required' => '密码不能为空',
   //               'pwds.max' => '密码不能超过6位',
   //           ]);
   //           if ($validator->fails()) {
   //               return redirect('/regist')
   //               ->withErrors($validator)
   //               ->withInput();
   //           }
   //  		// 判断用户 两次输入的密码是否正确
   //  		if ($all['user_pwd'] != $all['pwds']) {
   //  			return "<script>alert('密码不一致');parent.location.href='/regist';</script>";die;
   //  		}
   //  		// 入库
   //  		$all['user_pwd'] = md5($all['user_pwd']);
   //  		$all['pwds'] = md5($all['pwds']);
   //  		$data = ShopRegister::create($all);
   //  		if($data){
			// 	return redirect("/admin/login");
			// }
			// return redirect()->back();
   //  	}
   //  	return view('admin.regist');
   //  }
   //  // 登录
   //  public function login(Request $request)
   //  {
   //  	if ($request->isMethod('post')) {
   //  		$all = $request->except('_token');
   //  		$all['user_pwd'] = md5($all['user_pwd']);
   //  		$info = ShopRegister::where('user_name',$all['user_name'])->first();
   //  		if (empty($info)) {
	  //           return "<script>alert('账号不存在');parent.location.href='/admin/login';</script>";die;
	  //       }else{
	  //            //判断密码是否正确
	  //           if ($info['user_pwd']==$all['user_pwd']) {//用库里加密密码 == 接收的加密密码
	  //           	$request->session()->put('info',$info);
	  //           	return "<script>alert('登陆成功');parent.location.href='/admin/index';</script>";
	  //           }else{
	  //              return "<script>alert('密码不正确');parent.location.href='/admin/login';</script>";die;
	  //           }
	  //       }
   //  	}
   //  	return view('admin.login');
   //  }
    
}
