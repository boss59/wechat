<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;
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
                    "type"=>"view",
                    "name"=>"查询积分🎉",
                    "url"=>"http://www.soso.com/"
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
                   "url"=>"http://www.soso.com/"
                ],
                [
                    "type"=>"click",
                    "name"=>"大礼包🎁",
                    "key"=>"V1001_GOOD"
                ],
                [
                    "type"=>"click",
                    "name"=>"点赞👍",
                    "key"=>"V1001_GOOD"
                ]]
            ]]
        ];
        $arr = json_encode($data, JSON_UNESCAPED_UNICODE);
        $data = CurlController::curlpost($url,$arr);

        dd($data);
    }
}
