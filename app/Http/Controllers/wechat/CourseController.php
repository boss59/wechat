<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    // 课程
    public function course()
    {
        return view('wechat.course');
    }
}
