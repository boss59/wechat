<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chat\Tag;
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
        $msg = "我爱你！";
        if ($xml['Content'] == '1'){
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[有需要服务的吗？]]></Content></xml>";
        }
        if ($xml['Content'] == '521'){
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }

    }
}
