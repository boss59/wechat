<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * 接收 微信消息
     * @param Request $request
     */
    public function event(Request $request)
    {
        echo $_GET['echostr'];
    }
}
