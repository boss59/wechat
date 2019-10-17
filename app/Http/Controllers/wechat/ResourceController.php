<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
use App\Weui\Resource;
use Illuminate\Support\Facades\Storage;
class ResourceController extends Controller
{
    // 视图
    public function resource()
    {
        return view('wechat.index');
    }
    // 上传 零时素材
    public function resource_do(Request $request)
    {
        // 接类型
        $type = $request->input('type');
        dd($type);
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
    // 上传 永久素材
    public function type_do(Request $request)
    {
        // 接类型
        $req = $request->all();
        // 接name
        if (!$request->hasFile('resource')){
            echo "没有文件";die;
        }
        $file_obj =$request->file('resource');
        // 获取 token
        $token=CurlController::get_access_token();
        // 音频
        $file_ext = $file_obj->getClientOriginalExtension();
        $file_name = time().rand(1000,9999).'.'.$file_ext;
        //路径
        $path = $file_obj->storeAs('wechat/'.$req['type'],$file_name);
        //storage_path('app/public/'.$path);die;
        // 微信 post 请求
        $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$token.'&type='.$req['type'];
        $data = [
            'media'=>new \CURLFile(storage_path('app/public/'.$path)),
        ];
        if ($req['type'] == 'video'){
            $data['description'] = [
                'title' => '一叶之秋',
                'introduction' => '荣耀没你想的那么简单！'
            ];
            $data['description'] =json_encode($data['description'], JSON_UNESCAPED_UNICODE);
        }
//        dd($data);
        $re = CurlController::post_file($url,$data);
        $res =json_decode($re,1);
        if (!isset($res['errcode'])){
            $en=Resource::insert([
                'media_id' =>$res['media_id'],
                'type' =>$req['type'],
                'path' => '/storage/'.$path,
                'add_time' => time(),
            ]);
            if ($en){
                return redirect('/wechat/resource_list');
            }else{
                return redirect()->back();
            }
        }
    }
    // 展示 素材
    public function resource_list()
    {
        // 获取 token
        $token=CurlController::get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$token;
        $data = [
            'type' => 'image',
            'offset' => '0',
            'count' => 20
        ];
        $re = CurlController::curlpost($url,json_encode($data, JSON_UNESCAPED_UNICODE));
        $arr =json_decode($re,1);
        $data = Resource::get()->toarray();
        return view('wechat.list',['data'=>$data]);
    }
    // 清除 接口 调用次数
    public function aaa(){
        $token=CurlController::get_access_token();
        $url="https://api.weixin.qq.com/cgi-bin/clear_quota?access_token=".$token;
        $data=json_encode(['appid'=>env("WECGAT_APPID")]);
        $res=CurlController::curlpost($url,$data);
        $res=json_decode($res);
//        return $res;
        dd($res);
    }
    // 资源下载.....视频。。。。。
    public function download(Request $request)
    {
        $data = $request->all();
        $str=substr($data['path'],22);
        $token=CurlController::get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".$token;
        $res=CurlController::curlpost($url,json_encode(['media_id'=>$data['media_id']],JSON_UNESCAPED_UNICODE));
        // 设置 超时参数
        $opts = array(
            "http" => array(
                "method" => "GET",
                "timeout" => 3 //单位秒
            ),
        );
//        dd($res);
        // 创建 数据流 上下文
        $context = stream_context_create($opts);
        // 创建 数据流 上下文
        $res=json_decode($res,true,JSON_UNESCAPED_UNICODE);
        $file_soure = file_get_contents($res['down_url'],false,$context);
        $data=Storage::put('/wechat/download/'.$str,$file_soure);
        if (!isset($data)){
            echo "下载成功";
        }else{
            echo "下载失败";
        }
    }
}
