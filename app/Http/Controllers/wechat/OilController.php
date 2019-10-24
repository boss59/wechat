<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
class OilController extends Controller
{
    // 油价 查询
    public function oil()
    {
        $oil = CurlController::oil();
        dd($oil);
    }
}
