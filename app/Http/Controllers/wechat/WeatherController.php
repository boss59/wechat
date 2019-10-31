<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\CurlController;//请求
class WeatherController extends Controller
{
    // 天气
    public function weather()
    {
        $data = CurlController::weather();
        dd($data);
    }
}
