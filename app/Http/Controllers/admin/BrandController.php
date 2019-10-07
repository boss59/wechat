<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\CsBrand;
use Validator;
class BrandController extends Controller
{
	// 添加
    public function brandadd(Request $request)
    {
    	if ($request->isMethod('post')) {
    		$data = $request->except('_token');
    		// dd($data);
    		//文件上传
    		$path=Storage::putFile('goods_img',$request->file('brand_brand'));
            // dd($path);
            $all['goods_img'] = $path;
            // 添加
            // dd($data);
    		$status = CsBrand::create($data);
    		// dd($status);
    		if ($status) {
    			return redirect("/brand/brandlist");
    		}
            return redirect()->back();
    	}
    	return view('backend.brand.brandadd');
    }
    // 展示
    public function brandlist(Request $request)
    {
    	$list = CsBrand::get();
    	return view('backend.brand.brandlist',['list'=>$list]);
    }
    // 删除
    public function branddel(Request $request)
    {
        $brand_id=request()->get('brand_id');
        $res=CsBrand::where('brand_id',$brand_id)->delete();
        if($res){
            return redirect()->back();
        }
    }
    // 修改
    public function brandupdate(Request $request)
    {   
        $brand_id = $request->input('brand_id');
        $list=CsBrand::where('brand_id',$brand_id)->first();
        return view('backend.brand.brandupdate',['list'=>$list]);
    }
    public function brandupdatel(Request $request){
            $brand_id = $request->get('brand_id');
            $data = $request->except('_token');
            $res=CsBrand::where('brand_id',$brand_id)->update($data);
            if($res){
                return redirect("/brand/brandlist");
            }
          
    }
}
