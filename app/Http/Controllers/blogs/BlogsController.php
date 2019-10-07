<?php

namespace App\Http\Controllers\blogs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShopBlogs;
class BlogsController extends Controller
{
	// 首页
    public function index(Request $request)
    {
    	$list = ShopBlogs::paginate(2);
    	// dd($list);
    	return view('blogs.index',['list'=>$list]);
    }
}
