<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Request $request)
    {
    	$info = $request->session()->get('info');
    	// dd($info['user_name']);
    	return view('backend.index',['data'=>$info['user_name']]);
    }
}
