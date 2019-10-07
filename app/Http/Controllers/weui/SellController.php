<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellController extends Controller
{
    public function sell(Request $request)
    {
    	return view('index.sell');
    }
}
