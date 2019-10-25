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
        $a = "北京油价";
        $mb = mb_substr($a,0,-2);
        foreach($oil as $k=>$v){
            if(in_array($mb,$v)){
                $arr=$v;
            }

        }
        dd($arr['0h']);

    }
}
