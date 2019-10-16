<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chat\Tag;
use App\Http\Controllers\wechat\CurlController;//请求
use App\Http\Controllers\wechat\WachatController;//token
class EventController extends Controller
{
    public $Tag;
    public $request;
    public function __construct(Tag $tag,Request $request)
    {
        $this->tag = $tag;
        $this->request = $request;
    }
    /**
     * 接收 微信消息
     * @param Request $request
     */
    public function event()
    {
        //接收xml 消息
        $info = file_get_contents("php://input");
        // 将内容写入文件
        file_put_contents(storage_path('logs/wechat/'.date('Y-m-d').'.log'),"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents(storage_path('logs/wechat/'.date('Y-m-d').'.log'),$info,FILE_APPEND);
        // 将文件内容转义成字符串
        $xml_obj = simplexml_load_string($info,'SimpleXMLElement',LIBXML_NOCDATA);
        // 强制转为数组
        $xml = (array)$xml_obj;
        // 关注 回复
        if($xml['MsgType'] == 'event' && $xml['Event'] == 'subscribe'){
            $info = CurlController::getuser($xml['FromUserName']);
            $msg = '你好'.$info['nickname'].',欢迎关注我的公众号';
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }
        // 普通消息 回复
        if ($xml['MsgType'] == 'text' && $xml['Content'] == '1'){
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[有需要服务的吗？]]></Content></xml>";
        }else if ($xml['MsgType'] == 'text' && $xml['Content'] == '521'){
            $msg = "我爱你！";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }else if($xml['MsgType'] == 'text' && $xml['Content'] == '6'){
            $media_id ="tyXhwlo9Gh-761o1Fb6savT_RIhhLMcYXDpwUe8aJllFE2wNwMhwdEF7hHEoNd7u";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA[".$media_id."]]></MediaId></Voice></xml>";
        }else if($xml['MsgType'] == 'text' && $xml['Content'] == '8'){
            $media_id ="6cBYHyFtf74PI2o__6Uo0ErmgRPWevyLcA59PlFqtIhax__SImQlMoJ7pf3WdHXS";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[".$media_id."]]></MediaId></Image></xml>";
        }else{
            $msg = "纵情山河万里，肆意九州五岳！！！";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }
    }
}
