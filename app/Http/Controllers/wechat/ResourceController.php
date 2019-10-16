<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
class ResourceController extends Controller
{
    // 视图
    public function resource()
    {
        return view('wechat.index');
    }
    // 上传
    public function resource_do(Request $request)
    {
        // 接类型
        $type = $request->input('type');
        // 接name
        $file_obj =$request->file('resource');
        if (!$request->hasFile('resource')){
            echo "没有文件";die;
        }
        // 获取 token
        $token=CurlController::get_access_token();
        // 音频
        $file_ext = $file_obj->getClientOriginalExtension();
        $file_name = time().rand(1000,9999).'.'.$file_ext;
        //路径
        $path = $file_obj->storeAs('wechat/'.$type.'',$file_name);
        //storage_path('app/public/'.$path);die;
        // 微信 post 请求
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$token."&type=".$type;
        $re = CurlController::curl_file($url,storage_path('app/public/'.$path));
        $data =json_decode($re,1);
        dd($data);
    }
}
