<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\CsUser;
class WachatController extends Controller
{
    // 获取 token
    public static function wechat()
    {
//        \Cache::forget('access_token');die;
        // dd($value);
        if(\Cache::has('token')){
            $value = \Cache::get('access_token');
        }else{
            $info = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxc17d07531889d3ff&secret=bbed9e4037fe1536b8ff66d9493c16dc');
            $value = json_decode($info,true);
            \Cache::put('access_token', $value["access_token"], $value["expires_in"]);
            return $value["access_token"];
        }
        return $value;
    }
    // 用户信息
    public function index(Request $request)
    {
        $info = self::wechat();
        $user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$info."&next_openid=");
        $user = json_decode($user,1);
        // $data = $user['data'];
        // $openid = $data['openid'];
        // dd($openid);
        $infos = [];
        foreach($user['data']['openid'] as $k=>$v){
            $userinfo = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$info."&openid=".$v."&lang=zh_CN");
            $infos[] = json_decode($userinfo,1);
        }
        return view('index.wechat.index',['info'=>$infos]);  
    }
    // 获取 openid 方法
    public static function openid(Request $request)
    {
        $info = self::wechat();
        $user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$info."&next_openid=");
        $user = json_decode($user,1);
        $data = $user['data'];
        $openid = $data['openid'];
        return $openid;
    }
    // 用户授权
    public function userinfo()
    {
        //$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $app = urlencode(env('APP_URl').'/weui/wechatcode');
        // 第一步：用户同意授权，获取code
        $url = "location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECGAT_APPID')."&redirect_uri=$app&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        // dd($url);
        header($url);
    }
    //  第二步 通过code换取网页授权access_token
    public function wechatcode(Request $request)
    {
        $code = request()->input('code'); // 得到code
        // dd($code);
        $token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECGAT_APPID')."&secret=".env('WECHET_SECRET')."&code=".$code."&grant_type=authorization_code");
        $userinfo = json_decode($token,1);
//        dd($userinfo);
        $openid=$userinfo['openid'];
        // 查库
        $info=CsUser::where('openid','=',$openid)->first();
//        dd($info);
        if (!$info){
            // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
            $info = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$userinfo['access_token']."&openid=".$userinfo['openid']."&lang=zh_CN");
            $userinfo = json_decode($info,1);
            $data =[
                'phone'=>$userinfo['nickname'],
                'openid'=>$userinfo['openid'],
            ];
            $user_id=CsUser::insertGetId($data);//添加到用户表 获取userid
            $res=CsUser::where('user_id','=',$user_id)->first();
            if ($res){
                $data=$request->session()->put('userinfo',$res);
                return redirect('/weui/index');
            }else{
                return redirect()->back();
            }
        }else{
            $data=$request->session()->put('userinfo',$info);
            return redirect('/weui/index');
        }
    }
}
