<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
use App\Http\Controllers\wechat\WachatController;//token
class SignController extends Controller
{
    // 标签添加
    public function sign(Request $request)
    {
        if ($request->isMethod('post')) {
            $sign_name = $request->except('_token');
            $name = $sign_name['sign_name'];
            $token = WachatController::wechat();
            $url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token=".$token;
            $arr = [
                "tag" => [
                    "name" => $name,
                ],
            ];
            $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
            // 添加
            $sign = CurlController::curlpost($url,$arr);
            $sign = json_decode($sign, true, JSON_UNESCAPED_UNICODE);
            if ($sign){
                return redirect("/wechat/signindex");
            }
            return redirect()->back();
        }
        return view('backend.wechat.sign');
    }
    // 标签展示
    public function signindex(Request $request)
    {
        $token = WachatController::wechat();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".$token;
        $getsign = CurlController::curlget($url);
        $sign = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        return view('backend.wechat.signindex',['sign'=>$sign['tags']]);
    }
    // 标签 删除
    public function delsign(Request $request)
    {
        $id = $request->input('id');
        $token = WachatController::wechat();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=".$token;
        $arr = [
            "tag" => [
                "id" => $id,
            ],
        ];
        $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        // 删除
        $delsign = CurlController::curlpost($url,$arr);
        $delsign = json_decode($delsign, true, JSON_UNESCAPED_UNICODE);
        if ($delsign){
            header("/wechat/delsign");
        }
        return redirect()->back();
    }
    // 修改
    public function updatesign(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $arr = [
            "tag" => [
                "id" => $id,
                "name"=> $name
            ],
        ];
        if ($request->isMethod('post')) {
            $token = WachatController::wechat();
            $url = "https://api.weixin.qq.com/cgi-bin/tags/update?access_token=".$token;
            $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
            // 修改
            $sign = CurlController::curlpost($url,$arr);
            $res = json_decode($sign, true, JSON_UNESCAPED_UNICODE);
            if ($res){
                return redirect("/wechat/signindex");
            }else{
                return redirect("/wechat/fans");
            }

        }
        return view('backend.wechat.updatesign',['arr'=>$arr['tag']]);
    }
}
