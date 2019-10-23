<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\CsUser;
class LoginController extends Controller
{
	// 注册
	public function regist(Request $request)
	{
		if ($request->isMethod('post')) {
			$data = $request->except('_token');
			if (empty($data['phone'] && $data['userpwd'] && $data['conpwd'])) {
				echo json_encode(['code'=>0,'font'=>'不可为空']);die;
			}
			if (strlen($data['phone'])<11) {
				echo json_encode(['code'=>0,'font'=>'请输入正确的手机号']);die;
			}
			$check = '/^(1(([35789][0-9])|(47)))\d{8}$/';
			if (!preg_match($check,$data['phone'])) {
				echo json_encode(['code'=>0,'font'=>'请输入合法的手机号']);die;
			}
			if (empty($data['code'])) {
				echo json_encode(['code'=>0,'font'=>'请先勾选协议']);die;
			}
			if($data['userpwd'] != $data['conpwd']){
				echo json_encode(['code'=>0,'font'=>'密码不一致']);die;
			}
			$res = CsUser::create($data);
			if ($res) {
				echo json_encode(['code'=>1,'font'=>'注册成功']);die;
			}else{
				echo json_encode(['code'=>0,'font'=>'注册失败']);die;
			}
		}
		return view('index.login.regist');
	}
	// 登陆
    public function Login(Request $request)
    {
    	$refer = $request->input('refer');
    	$confirm = $request->input('confirm');
    	// dd($confirm);
    	if ($request->isMethod('post')) {
    		$data = $request->except('_token');
    		// 验证
    		// dd($data);
    		$validator = \Validator::make($data, [
                'phone' => 'required',
                'userpwd' => 'required',
            ],[
                'phone.required' => '手机号不能为空',
                // 密码
                'userpwd.required' => '密码不能为空',
            ]);
	        if ($validator->fails()) {
	             return redirect('/weui/Login')
	             ->withErrors($validator)
	             ->withInput();
	        }
	        // 用户验证
//	       	 dd($data);
    		$info = CsUser::where('phone',$data['phone'])->first();
    		if (empty($info)) {
	            return "<script>alert('账号不存在');parent.location.href='/weui/Login';</script>";die;
	        }else{
	             //判断密码是否正确
	            if ($info['userpwd']==md5($data['userpwd'])) {//用库里加密密码 == 接收的加密密码
	            	$request->session()->put('userinfo',$info);
	            	if (!empty($refer)) {
	            		return redirect($refer);
	            	}else if(!empty($data['confirm'])){
	            		return redirect($data['confirm']);
	            	}else{
	            		return "<script>alert('登陆成功');parent.location.href='/weui/index';</script>";
	            	}
	            }else{
	               return "<script>alert('密码不正确');parent.location.href='/weui/Login';</script>";die;
	            }
	        }
    	}
    	return view('index.login.Login',['refer'=>$refer,'confirm'=>$confirm]);
    }
    // 协议
    public function xieyi()
    {
    	return view('index.login.xieyi');
    }
}
