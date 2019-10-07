<?php

namespace App\Http\Controllers\blogs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\ShopBlogs;
use Validator;
class ArticleController extends Controller
{
    public function articleadd(Request $request)
    {
    	if ($request->isMethod('post')) {
    		$data = $request->except('_token');
    		// 验证
    		$validator = Validator::make($data, [
                'title' => 'required|unique:shop_title|max:20',
                'man' => 'required|max:10|',
                'content' => 'required',
                // 'img' =>'sometimes|image',
             ],[
                'title.required' => '标题不能为空',
                'title.unique' => '标题已存在',
                'title.max' => '标题最大为20个字符',
                // 作者
                'man.required' => '作者不能为空',
                'man.max' => '标题最大为10个字符',
               	// 内容
               	'content.required' => '内容不能为空',
                // 文件上传
                // 'image' => ':attribute 必须是图片',
             ]);
	        if ($validator->fails()) {
		        return redirect('/blogs/articleadd')
				        ->withErrors($validator)
				        ->withInput();
	        }
            // 文件上传
            
            // 第二种
            // 
            // dd($path);
            // $data['img'] = $path;
	        // 添加
            $path = null;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                // 第一种
                $path = $request->file('img')->store('public');
                $path = $request->file('img')->store('public');
            } 
            // dd($path);
            $data['img'] = strstr($path,'/');
	        $res = ShopBlogs::create($data);
	        // dd($res);
	        if ($res) {
                // 一次性 session
                session()->flash('status',"添加成功，文章id为".$res->tid);
	        	return redirect("/blogs/index");
	        }
	        return redirect()->back();
    	}
    	return view('blogs.articleadd');
    }
    // 文章 详情
    public function detail(Request $request)
    {
        $id = $request->get('id');
        $data = ShopBlogs::findorFail($id);
        return view('blogs.detail',['data'=>$data]);
    }
    // 修改
    public function update(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            // 文件上传
            $path = null;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                // 第一种
                // $path = $request->file('img')->store('public'); 
                $path = Storage::putFile('imgs',$request->file('img'));
            } 
            // dd($path);
            if (isset($path)) {
                $data['img'] = $path;
            } 
            // dd($data);
            $res = ShopBlogs::where(['tid'=>$data['tid']])->update($data);
            // dd($res);
            if ($res) {
                return redirect("/blogs/index")->with('success',"修改成功id为".$data['tid']);
            }
            return redirect()->back();
        }
        $id = $request->get('id');
        $info = ShopBlogs::findorFail($id);
        return view('blogs.update',['info'=>$info]);
    } 
    // 删除
    public function del(Request $request)
    {

    }
}
