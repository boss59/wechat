<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
use App\Weui\UserintModels;
use App\Weui\OpenidModel;
use App\Weui\CsUser;
use App\Weui\Course;
use Illuminate\Support\Facades\Cache;
class EventController extends Controller
{
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
        $info = CurlController::getuser($xml['FromUserName']);
        $user=UserintModels::where('openid','=',$xml['FromUserName'])->first();
        $openid_info = OpenidModel::where(['openid'=>$xml['FromUserName']])->first();
        // 关注
        if($xml['MsgType'] == 'event' && $xml['Event'] == 'subscribe'){
            //判断openid表是否有当前openid   生成的二维码
            if(empty($openid_info)){
                //首次关注
                if(isset($xml['Ticket'])){
                    //带参数
                    $share_code = explode('_',$xml['EventKey'])[1];
                    OpenidModel::insert([
                        'user_id'=>$share_code,
                        'openid'=>$xml['FromUserName'],
                        'subscribe'=>1
                    ]);
                    CsUser::where(['user_id'=>$share_code])->increment('share_num',1); //加业绩
                }else{
                    //普通关注
                    OpenidModel::insert([
                        'user_id'=>0,
                        'openid'=>$xml['FromUserName'],
                        'subscribe'=>1
                    ]);
                }
            }
            //========= 测试号关注=========
            if(!$user){
                UserintModels::insert([
                    'openid'=>$xml['FromUserName'],
                    'name'=>$info['nickname'],
                    'add_time'=>time(),
                    'sign_num' =>'0',
                    'sign_day' =>'0',
                    'integral'=>'0'
                ]);
                $msg = '你好'.$info['nickname'].',欢迎关注我的公众号';
            }else{
                $msg = '欢迎回来'.$info['nickname'].',关注我的公众号';
            }
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }

        // 签到 回复
        if ($xml['MsgType'] == 'event' && $xml['Event'] == 'CLICK' && $xml['EventKey'] == 'V1001_00') {
            //判断是否签到
            $today = date('Y-m-d',time()); //今天
            $last_day = date('Y-m-d',strtotime("-1 days")); //昨天
            if($user->sign_day == $today){
                // 已经签到
                $msg ="今日已签到";
            }else{
                // 签到
                $msg ="签到成功";
                //根据签到次数加积分
                //连续签到
                if($user->sign_day == $last_day){
                    // 连续签到
                    $sign_num = $user->sign_num +1;
                    if ($sign_num >= 6){
                        $sign_num =1;
                    }
                    UserintModels::where(['openid'=>$xml['FromUserName']])->update([
                        'sign_day'=>$today,
                        'sign_num'=>$sign_num,
                        'integral'=>$user->integral + 5 * $sign_num
                    ]);
                }else{
                    // 非连续签到
                    UserintModels::where(['openid'=>$xml['FromUserName']])->update([
                        'sign_day'=>$today,
                        'sign_num'=>1,
                        'integral'=>$user->integral + 5
                    ]);
                }
            }
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }

        // 积分查询
        if ($xml['MsgType'] == 'event' && $xml['Event'] == 'CLICK' && $xml['EventKey'] == 'select_00'){
            $msg = "积分为".$user['integral']."";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }


        // 课程管理
        $data = Course::where('openid',$xml['FromUserName'])->first();
        if ($xml['MsgType'] == 'event' && $xml['Event'] == 'CLICK' && $xml['EventKey'] == 'course_select'){
            if(empty($data)){
                $msg = "还未选择课程 请选择课程";
            }else{
                $msg = "课程提醒\n第一节课：".$data['one']."\n第二节课：".$data['two']."\n第三节课：".$data['three']."\n第四节课：".$data['four']."";
            }
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }

        // 油价 消息回复 查询
        if($xml['MsgType'] == 'text' && strpos($xml['Content'],'油价')){
            $city = mb_substr($xml['Content'],0,-2);
            $city_num = \Cache::increment($city.":num");
            if($city_num > 10){
                $msg = \Cache::get($city.":data");
                $this->oil($msg,$xml['FromUserName']);die;
            }
            // 获取 油价信息
            $result = CurlController::oil();
            //缓存今天的油价信息
            if(!\Cache::has(date('Y-m-d',time()))){
                \Cache::put(date('Y-m-d',time()),$result,2 * 24 * 3600);
            }

            $city_arr = [];
            foreach($result as $v){
                $city_arr[] = $v['city'];
            }
            if(!in_array($city,$city_arr)){
                $msg = '不支持当前城市！';
                echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
                die();
            }
            foreach($result as $v){
                if($v['city'] == $city){
                    if($city_num == 10){
                        \Cache::put($city.':data',$v);
                    }
                    $this->oil($v,$xml['FromUserName']);
                }
            }
        }

        // 天气 回复
        if($xml['MsgType'] == 'text' && strpos($xml['Content'],'天气')){
            $name = mb_substr($xml['Content'],0,-2);
            // 获取城市
            $city = CurlController::city();
            $arr = [];
            foreach($city['result']['datas'] as $k=>$v){
                if($v['citynm'] == $name){
                    // 获取 一周天气信息
                    $appkey = "46229";
                    $sign = "1415b1373fb75b12b3869c734ff9f611";
                    $url = "http://api.k780.com/?app=weather.future&weaid=".$v['weaid']."&appkey=" . $appkey . "&sign=" . $sign . "&format=json";
                    $data = CurlController::curlget($url);
                    $res =json_decode($data,1);
                    foreach($res['result'] as $k=>$v){
                        $msg=$v['days'].",".$v['citynm'].",".$v['week'].",".$v['temperature'].",".$v['weather']."\n";
                        $arr[] = $msg;
                    }
                    echo "<xml><ToUserName><![CDATA[" . $xml['FromUserName'] . "]]></ToUserName><FromUserName><![CDATA[" . $xml['ToUserName'] . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $arr['0'].$arr['1'].$arr['2'].$arr['3'].$arr['4'].$arr['5'].$arr['6']. "]]></Content></xml>";die;
                }
            }
        }
        // 普通消息 回复
        if ($xml['MsgType'] == 'text' && $xml['Content'] == '1'){
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[有需要服务的吗？]]></Content></xml>";
        }else if ($xml['MsgType'] == 'text' && $xml['Content'] == '521'){
            $msg = "我爱你！";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }else if($xml['MsgType'] == 'text' && $xml['Content'] == '6'){
            $media_id ="mykIkSBhsIL2j3DNMTnCA3-YCyEeRFzxmw-h8fVly3s";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA[".$media_id."]]></MediaId></Voice></xml>";
        }else if($xml['MsgType'] == 'text' && $xml['Content'] == '8'){
            $media_id ="mykIkSBhsIL2j3DNMTnCA4rWmnQx57vwf2MecNefBY8";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[".$media_id."]]></MediaId></Image></xml>";
        }else if($xml['MsgType'] == 'text' && $xml['Content'] == '9'){
            $media_id ="mykIkSBhsIL2j3DNMTnCA2JS3GtrD_g076r0EQMofb4";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[".$media_id."]]></MediaId><Title>"."遇见"."</Title><Description>"."我遇见谁会有怎样的对白,我等的人他在多远的未来,我听见风来自地铁和人海,我排著队拿著爱的号码牌"."</Description></Video></xml>";exit;
        }else{
            $msg = "纵情山河万里，肆意九州五岳！！！";
            echo "<xml><ToUserName><![CDATA[".$xml['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$msg."]]></Content></xml>";
        }
    }
    // 油价查询
    public function oil($v,$info)
    {
        $token = CurlController::get_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
        $data = [
            'touser'=>$info,
            'template_id'=>'oKrOgK-HLTG3-_8XoVn7MU0Qb4RPDOc0jHHqF5kRWx8',
            'data'=>[
                'keyword1'=>[
                    'value'=>$v['city'],
                    'color'=>''
                ],
                'keyword2'=>[
                    'value'=>$v['92h'],
                    'color'=>''
                ],
                'keyword3'=>[
                    'value'=>$v['95h'],
                    'color'=>''
                ],
                'keyword4'=>[
                    'value'=>$v['98h'],
                    'color'=>''
                ],
                'keyword5'=>[
                    'value'=>$v['0h'],
                    'color'=>''
                ],
            ]
        ];
        $arr = json_encode($data, JSON_UNESCAPED_UNICODE);
        $fans = CurlController::curlpost($url,$arr);
        $data = json_decode($fans, true, JSON_UNESCAPED_UNICODE);
    }
}
