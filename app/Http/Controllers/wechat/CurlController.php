<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CurlController extends Controller
{
    // 获取 token
    public static function get_access_token()
    {
        $key = "access_token";
        //判断缓存是否存在
        if(\Cache::has($key)) {
            //取缓存
            $access_token = \Cache::get($key);
        }else{
            //取不到，调接口，缓存
            $re = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WECGAT_APPID').'&secret='.env('WECHET_SECRET'));
            $result = json_decode($re,true);
            \Cache::put($key,$result['access_token'],$result['expires_in']);
            $access_token = $result['access_token'];
        }
        return $access_token;
    }
    // get 请求
    public static function curlget($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    // post 请求
    public static function curlpost($url,$data)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    // 标签 列表
    public static function tag_list()
    {
        $token = self::get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".$token;
        $getsign = CurlController::curlget($url);
        $sign = json_decode($getsign, true, JSON_UNESCAPED_UNICODE);
        return $sign;
    }
    // 粉丝信息
    public static function getuser($openid)
    {
        $token = self::get_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
        $re = file_get_contents($url);
        $result = json_decode($re,1);
        return $result;
    }
    // 获取 所有 粉丝 信息
    public static function fans_list()
    {
        $token = self::get_access_token();
        $user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$token."&next_openid=");
        $user = json_decode($user,1);
//         $data = $user['data'];
//         $openid = $data['openid'];
//         dd($openid);
        $infos = [];
        foreach($user['data']['openid'] as $k=>$v){
            $userinfo = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$v."&lang=zh_CN");
            $infos[] = json_decode($userinfo,1);
        }
        return $infos;
    }
    // 上传 素材
    public static function curl_file($url,$push)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($curl,CURLOPT_POST,true);

        $data = [
            'meida' =>new \CURLFile(realpath($push)),
        ];

        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    // 验 签
    public static function sdk()
    {
        $token = self::get_access_token();
        $key = 'sdk';
        //判断缓存是否存在
        if(\Cache::has($key)) {
            //取缓存
            $sdk = \Cache::get($key);
        }else{
            //取不到，调接口，缓存
            $re = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$token.'&type=jsapi');
            $result = json_decode($re,true);
            \Cache::put($key,$result['ticket'],$result['expires_in']);
            $sdk = $result['ticket'];
        }
        return $sdk;
    }
    // 油价 查询
    public static function oil()
    {
        $key = 'oil';
        if(\Cache::has($key)){
            // 取缓存
            $appoil = \Cache::get($key);
        }else{
            $appkey = "7ca1ac6cb8adf854203f3e2a165394e6";
            $url = 'http://apis.juhe.cn/cnoil/oil_city?key='.$appkey;
            $re = self::curlget($url);
            $oil = json_decode($re,1);
            \Cache::put($key,$oil['result'],86400);
            $appoil = $oil['result'];
        }
        return $appoil;
    }
}
