<?php

namespace App\Http\Controllers\blogs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginSuccess;
use App\Jobs\SendEmail;
class UserController extends Controller
{
	protected $msg = "邮件主题";
	// 注销
    public function logout(Request $request)
    {
    	// 退出 登陆
    	Auth::guard()->logout();
    	// 跳转 地址 首页
    	return redirect('/blogs/index');
    }
    // 发邮件
    public function send(Request $request)
    {
    	// dd(Auth::user()->name);
    	// Mail::to($request->user())->send(new LoginSuccess(Auth::user()->name));
    	// 方式 二
    	// Mail::raw('标题',function($messade){
    	// 	$message->to('邮箱');
    	// 	$message->subject("这是一封测试邮件");
    	// })
    	// 方式 三
    	// Mail::send('email.loginsuccess',['username'=>$request->user()->name],function($message){
    	// 	$messade->to('邮箱');
    	// 	$message->subject($this->subject);
    	// })
    	// $this->dispatch(new SendEmail($request->user(),"这是一个发送邮件的团队测试",'2141241321321'));
    	Mail::to($request->user())->queue(new LoginSuccess($request->user()->name,"队列测试"));
    	return "发邮件成功";
    }
}
