<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\Course;

class CourseController extends Controller
{
    // 课程
    public function course(Request $request)
    {
        $openid = $request->session()->get('openid');
        if (empty($openid)) {
            // 网页授权
            $app = urlencode(env('APP_URL').'/wechat/add_course');
            // 第一步：用户同意授权，获取code
            $url = "location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECGAT_APPID') . "&redirect_uri=" . $app . "&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            header($url);
        } else {
            return redirect('/wechat/index_course');
        }
    }
    public function add_course(Request $request)
    {
        $code = request()->input('code'); // 得到code
        $token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECGAT_APPID')."&secret=".env('WECHET_SECRET')."&code=".$code."&grant_type=authorization_code");
        $userinfo = json_decode($token,1);
//        dd($userinfo['openid']);
        // 查库
        $info=Course::where('openid',$userinfo['openid'])->first();
        if (!$info){
            // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
            $info = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$userinfo['access_token']."&openid=".$userinfo['openid']."&lang=zh_CN");
            $userinfo = json_decode($info,1);
            $data =[
                'name'=>$userinfo['nickname'],
                'openid'=>$userinfo['openid'],
            ];
            $user_id=Course::insertGetId($data);//添加到用户表 获取userid
            $res=Course::where('cid','=',$user_id)->first();
            if ($res){
                $request->session()->put('openid',$res);
                return redirect('/wechat/index_course');
            }else{
                return redirect()->back();
            }
        }else{
            $request->session()->put('openid',$info);
            return redirect('/wechat/index_course');
        }
    }
    // 课程
    public function index_course(Request $request)
    {
        $openid=$request->session()->get('openid')->toArray();
//        if ()
//        $res=Course::where(['openid'=>$openid['openid']])->update([
//            'one'=>$userinfo['nickname'],
//            'openid'=>$userinfo['openid'],
//        ]);
        return view('wechat.course');
    }
}
