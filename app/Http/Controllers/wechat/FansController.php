<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
use App\Http\Controllers\wechat\WachatController;//token
use App\Chat\Tag;
class FansController extends Controller
{
    public $Tag;
    public $request;
    public function __construct(Tag $tag,Request $request)
    {
        $this->tag = $tag;
        $this->request = $request;
    }
    // 粉丝列表
    public function fans(Request $request)
    {
        $id = $request->input('id');
        // 获取 asess_token
        $token = WachatController::wechat();
        //dd($token);
        // 获取open_id
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$token."&next_openid=";
        // 获取 所有 粉丝
        $getsign = CurlController::curlget($url);
        $fans = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        //dd($fans);
        // 获取 所有 粉丝 信息
        $data = [];
        foreach($fans['data']['openid'] as $k=>$v){
            $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$v."&lang=zh_CN";
            $getsign = CurlController::curlget($url);
            $data[] = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        }
        //dd($data);
        return view('backend.wechat.fans',['data'=>$data,'id'=>$id]);
    }
    // 为粉丝打标签
    public function addsign(Request $request)
    {
        $id = $request->input('id');
        $openid = $request->input('openid_list');
        $token = WachatController::wechat();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=".$token;
        $arr = [
            'openid_list' =>$openid,
            'tagid' =>$id
        ];
        $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        $getsign = CurlController::curlpost($url,$arr);
        $data = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        if ($data){
            return redirect('/wechat/signindex');
        }else{
            return redirect('/wechat/fans');
        }

    }
    // 所属 标签
    public function tagsign(Request $request)
    {
        $openid=$request->input('openid');
        $token = WachatController::wechat();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=".$token;
        $arr = [
            'openid' =>$openid,
        ];
        $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        $getsign = CurlController::curlpost($url,$arr);
        $res = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        //获取 所有 标签
        $sign = CurlController::tag_list()['tags'];
        foreach($res['tagid_list'] as $k=>$v){
            foreach($sign as $k=>$vo){
                if($v==$vo['id']){
                    echo $vo['name']."<br />";
                }
            }
        }
    }
    // 这个 标签 下的粉丝
    public function tagfans(Request $request)
    {
        $id=$request->input('id');
//        dd($id);
        $token = WachatController::wechat();
        $url = "https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=".$token;
        $arr = [
            "tagid" =>$id,
            "next_openid"=>[],
        ];
        $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        $getsign = CurlController::curlpost($url,$arr);
        $fans = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        // 拉取 用户信息
        $data = [];
        foreach($fans['data']['openid'] as $k=>$v){
            $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$v."&lang=zh_CN";
            $getsign = CurlController::curlget($url);
            $data[] = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        }
        return view('backend.wechat.fans',['data'=>$data,'id'=>$id]);
    }
    // 取消 当前 用户的 表签
    public function delfans(Request $request)
    {
        $id = $request->input('id');
        $openid = $request->input('openid');
//        var_dump($id);
//        dd($openid);
        $token = WachatController::wechat();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=".$token;
        $arr = [
            'openid_list' =>$openid,
            'tagid' =>$id
        ];

        $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        $fans = CurlController::curlpost($url,$arr);
        $data = json_decode($fans, true, JSON_UNESCAPED_UNICODE);
        dd($data);
    }
    // 模板消息
    public function pushmsg(Request $request)
    {
        $data = $request->input('openid');
        $data=implode($data,',');
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
}
