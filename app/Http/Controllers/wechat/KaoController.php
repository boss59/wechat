<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
class KaoController extends Controller
{
    public function add()
    {
        return view('kao.index');
    }
    // 授权登陆
    public function user()
    {
        $app = urlencode(env('APP_URl').'/wechat/code');
        // 第一步：用户同意授权，获取code
        $url = "location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECGAT_APPID')."&redirect_uri=".$app."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        // dd($url);
        header($url);
    }
    //   第二步 通过code换取网页授权access_token
    public function code(Request $request)
    {
        $code = request()->input('code'); // 得到code
        $token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECGAT_APPID')."&secret=".env('WECHET_SECRET')."&code=".$code."&grant_type=authorization_code");
        $userinfo = json_decode($token,1);
        //dd($userinfo);
        $openid=$userinfo['openid'];
        // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        $info = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$userinfo['access_token']."&openid=".$userinfo['openid']."&lang=zh_CN");
        $userinfo = json_decode($info,1);
        //dd($userinfo);
        // 存session
        if ($userinfo){
            $request->session()->put('info',$userinfo);
            return redirect('/wechat/getinfo');
        }
    }
    // 粉丝列表
    public function getinfo()
    {
//        $a= session()->get('info');
//        dd($a);
        $infos = CurlController::fans_list();
        return view('kao.list',['data'=>$infos]);
    }
    // 群发消息
    public function message(Request $request)
    {
        $data=$request->input('openid_list');
        $token = WachatController::wechat();
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".$token;
        $data =[
            "touser"=>$data,
            "image"=>[
                    "media_id"=>"mykIkSBhsIL2j3DNMTnCA49X2gOOdB3Y3mzpxw5aUBg"
            ],
            "msgtype"=> "text",
            "text"=> ["content"=> "纵情山河万里，肆意九州五岳！！！"]
        ];
//        dd($data);
        $arr = json_encode($data, JSON_UNESCAPED_UNICODE);
        $fans = CurlController::curlpost($url,$arr);
        $data = json_decode($fans, true, JSON_UNESCAPED_UNICODE);
        dd($data);

    }
    // 单发消息
    public function dan(Request $request)
    {
        $data = $request->input('openid');
        $token = WachatController::wechat();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
        $data = [
            'touser'=>$data,
            'template_id'=>'fp9I6NJ0l9wSMznGNAtc90sNt7rclx--dzrDBl-ohyQ',
            'data'=>[
                'keyword1'=>[
                    'value'=>'用户',
                    'color'=>''
                ],
                'keyword2'=>[
                    'value'=>'洗发水',
                    'color'=>''
                ]
            ]
        ];
        $arr = json_encode($data, JSON_UNESCAPED_UNICODE);
        $fans = CurlController::curlpost($url,$arr);
        $data = json_decode($fans, true, JSON_UNESCAPED_UNICODE);
        dd($data);
    }
    // 压缩 字符串
    public function yyy(){
        $a="qqwwwwwcccciiiixxxxxbbbbdddyyy";
        $num=strlen($a);
        $str="";
        for ($i=0;$i<$num;$i++){
            $b=$a[$i];
            $c=0;
            if($i+1<$num&&$b!==$a[$i+1]||$i+1==$num) {
                for ($q = 0; $q < $num; $q++) {
                    if ($b == $a[$q]) {
                        $c += 1;
                    }
                }
                $d=$c-1;
                if ($d!=0){
                    $str.=$d;
                }
                $str.=$b;
            }
        }
        echo $str;
    }
}
