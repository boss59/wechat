<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\Course;
class CourseController extends Controller
{
    // 课程
    public function course()
    {
        // 网页授权
        $app = urlencode(env('APP_URl').'/wechat/add_course');
        // 第一步：用户同意授权，获取code
        $url = "location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECGAT_APPID')."&redirect_uri=".$app."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        // dd($url);
        header($url);

    }
    public function add_course()
    {
        $code = request()->input('code'); // 得到code
        $token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECGAT_APPID')."&secret=".env('WECHET_SECRET')."&code=".$code."&grant_type=authorization_code");
        $userinfo = json_decode($token,1);
        //dd($userinfo);
        $openid=$userinfo['openid'];
        // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        $info = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$userinfo['access_token']."&openid=".$userinfo['openid']."&lang=zh_CN");
        $userinfo = json_decode($info,1);
        if($userinfo){
            $res=Course::insert([
                'openid'=>$userinfo['openid'],
                'name' =>$userinfo['nickname'],
                'one' =>0,
                'two' =>0,
                'three' =>0,
                'four' =>0,
                'num' =>0,
            ]);
            if ($res){
                return view('wechat.course',['openid'=>$userinfo['openid']]);
            }else{
                return redirect('/wechat/course');
            }
        }
    }
    // 课程
    public function index_course(Request $resquest)
    {
        return view('wechat.course');
    }
}
