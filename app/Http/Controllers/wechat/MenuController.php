<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;
use App\Weui\MenuModels;
class MenuController extends Controller
{
    // 自定义菜单
    public function menu(Request $request)
    {
        // 获取 token
        $token=CurlController::get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
        $data =
        [
                "button"=>[
            [
                "name"=>"积分👑",
                "sub_button"=>[
                [
                    "type"=> "scancode_waitmsg",
                    "name"=> "扫一扫👐",
                    "key"=> "rselfmenu_0_0",
                    "sub_button"=> [ ]

                ],
                [
                    "type"=>"click",
                    "name"=>"每日签到🎖",
                    "key"=>"V1001_00"
                ],
                [
                    "type"=>"click",
                    "name"=>"查询积分🎉",
                    "key"=>"select_00"
                ]
            ]],

            [
                "name" =>"发图",
                "sub_button"=>[
                    [
                        "type"=>"pic_sysphoto",
                        "name"=>"系统拍照发图",
                        "key"=>"rselfmenu_1_0",
                        "sub_button"=>[]
                    ],
                    [
                        "type"=> "pic_photo_or_album",
                        "name"=> "拍照或者相册发图",
                        "key"=> "rselfmenu_1_1",
                        "sub_button"=> [ ]
                    ],
                    [
                        "type"=> "pic_weixin",
                        "name"=> "微信相册发图",
                        "key"=> "rselfmenu_1_2",
                        "sub_button"=> [ ]
                    ]
                ]
            ],

            [
                "name"=>"商城💎",
                "sub_button"=>[
                [
                   "type"=>"view",
                   "name"=>"进入商城⛳",
                   "url"=>"http://www.vonetxs.com/weui/index"
                ],
                [
                    "type"=>"click",
                    "name"=>"大礼包🎁",
                    "key"=>"V1001_GOOD"
                ],
                [
                    "type"=>"click",
                    "name"=>"点赞👍",
                    "key"=>"V1001_GOO"
                ]]
            ]]
        ];
        $arr = json_encode($data, JSON_UNESCAPED_UNICODE);
        $data = CurlController::curlpost($url,$arr);

        dd($data);
    }
    // 菜单
    public function menu_add()
    {
        $first_menu = MenuModels::where(['type'=>3])->select(['name','mid'])->get();
        return view('menu.index',['menu'=>$first_menu]);
    }
    // 添加
    public function menu_create(Request $request)
    {
        $req = $request->all();
//        dd($req);
        if ($req['type'] == 1){
            $first_count = MenuModels::where('type','!=','2')->count();
            if($first_count >= 3){
                dd('菜单超限');
            }
            MenuModels::insert([
                'name' =>$req['first_name'],
                'event'=>$req['event'],
                'event_key'=>$req['event_key'],
                'type'=>$req['type'],
                'parent_id'=>0
            ]);
        }else if($req['type'] == 2){
            $menu_count = MenuModels::where('parent_id','=',$req['name'])->count();
            if($menu_count >= 5){
                dd("菜单超限");
            }
            MenuModels::insert([
                'name' =>$req['second_name'],
                'event'=>$req['event'],
                'event_key'=>$req['event_key'],
                'type'=>$req['type'],
                'parent_id'=>$req['name']
            ]);
        }else if($req['type'] == 3){
            $first_count = MenuModels::where('type', '!=', '2')->count();
            if ($first_count >= 3) {
                dd("菜单超限");
            }
            MenuModels::insert([
                'name' =>$req['first_name'],
                'event'=>"",
                'event_key'=>"",
                'type'=>$req['type'],
                'parent_id'=>0
            ]);
        }
        $this->array();
    }
    // 数组 拼接
    public function  array()
    {
        $menu_list = MenuModels::where(['parent_id'=>0])->get();
        $data = [];
        foreach($menu_list as $k=>$v){
            if ($v['type'] ==1){
                // 普通一级
                if($v['event'] == 'click'){
                   $data['button'][] =[
                        "type"=>"click",
                        "name"=>$v['name'],
                        "key"=>$v['event_key']
                   ];
                }else if($v['event'] == 'view'){
                    $data['button'][] =[
                        "type"=>"view",
                        "name"=>$v['name'],
                        "url"=>$v['event_key']
                    ];
                }

            }else if($v['type'] == 3){
                // 当前一级下的二级
                $menu = MenuModels::where(['parent_id'=>$v])->get();
//                dd($menu);
                $menu_arr =[];
                $menu_arr['name'] =$v['name'];
                foreach($menu as $k=>$vo){
                    if($vo['event'] == 'click'){
                        $menu_arr['sub_button'][]=[
                            "type"=>"click",
                            "name"=>$v['name'],
                            "key"=>$vo['event_key']
                        ];
                    }else if($vo['event'] == 'view'){
                        $menu_arr['sub_button'][]=[
                            "type"=>"view",
                            "name"=>$v['name'],
                            "url"=>$vo['event_key']
                        ];
                    }

                }
                $data['button'][] =$menu_arr;
            }

        }
//        dd($data);
        // 获取 token
        $token=CurlController::get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
        $arr = json_encode($data, JSON_UNESCAPED_UNICODE);
        $data = CurlController::curlpost($url,$arr);
        dd($data);
    }
}
