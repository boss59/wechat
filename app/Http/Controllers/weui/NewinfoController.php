<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewinfoController extends Controller
{
	// 新闻 详情
    public function newinfo(Request $request)
    {
    	return view('index.new.newinfo');
    }
    // 新闻 列表
    public function newlist(Request $request)
    {
    	return view('index.new.newlist');
    }
}
