<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\Course;
use App\Http\Controllers\wechat\CurlController;//请求
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

        // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        $info = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$userinfo['access_token']."&openid=".$userinfo['openid']."&lang=zh_CN");
        $userinfo = json_decode($info,1);
        if ($userinfo){
            $request->session()->put('openid',$userinfo);
            return redirect('/wechat/index_course');
        }
    }
    // 课程
    public function index_course(Request $request)
    {
        $info=$request->session()->get('openid');
        $data = Course::where('openid',$info['openid'])->first();
        return view('wechat.course',['data'=>$data]);
    }
    // 添加
    public function update_cousre(Request $request)
    {
        $all= $request->input();
        $info=$request->session()->get('openid');
        $data = Course::where('openid',$info['openid'])->first();
        if (empty($data)){
            Course::insert([
                'openid'=>$info['openid'],
                'name'=>$info['nickname'],
                'one'=>$all['one'],
                'two'=>$all['two'],
                'three'=>$all['three'],
                'four'=>$all['four'],
            ]);
        }else{
            if ($data['num'] <= 3){
                dd('次数达到上限，超过三次');
            }else{
                Course::where(['openid'=>$info['openid']])->update([
                    'one'=>$all['one'],
                    'two'=>$all['two'],
                    'three'=>$all['three'],
                    'four'=>$all['four'],
                ]);
                Course::where(['openid'=>$info['openid']])->increment('num',1);
            }
        }
    }
}
