<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\CsUser;
use App\Http\Controllers\wechat\CurlController;
use Illuminate\Support\Facades\Storage;
class QrcodeController extends Controller
{
    public function qrcode()
    {
        $info = CsUser::get()->toArray();
        return view('wechat.qrcode',['data'=>$info]);
    }
    // 生成二维码
    public function add_code(Request $request)
    {
        $req = $request->input('user_id');
        $token = CurlController::get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$token;
//        {"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
        $data = [
            'action_name'=>'QR_LIMIT_SCENE',
            'action_info'=>[
                'scene'=>[
                    'scene_id'=>$req,
                ]
            ],
        ];
        $arr = json_encode($data, JSON_UNESCAPED_UNICODE);
        $fans = CurlController::curlpost($url,$arr);
        $data = json_decode($fans, true, JSON_UNESCAPED_UNICODE);
        //通过 ticket 换取二维码
        $qrcode_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$data['ticket'];
        $qrcode_source = CurlController::curlget($qrcode_url);
        $name = $req.rand(1000,9999).'.jpg';
        Storage::put('/wechat/qrcode/'.$name,$qrcode_source);
        CsUser::where(['user_id'=>$req])->update([
            'qrcode_url' => '/storage/wechat/qrcode/'.$name
        ]);
        return redirect('/wechat/qrcode');
    }
    // 验 签 sdk
    public function sdk()
    {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $appid = env('WECGAT_APPID');
        $_now_ = time();
        $rand_str = rand(1000,9999).'jssdk'.time();
        $jsapi_ticket = CurlController::sdk();
        $sign_str = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$rand_str.'&timestamp='.$_now_.'&url='.$url;
        $signature = sha1($sign_str);
        return view('wechat.sdk',['signature'=>$signature,'appid'=>$appid,'time'=>$_now_,'rand_str'=>$rand_str]);
    }
}
