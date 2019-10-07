<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CsCate;

class CateController extends Controller
{
	//分类添加
   	public function cateadd(Request $request){
   		if ($request->isMethod('post')) {
    		$data = $request->except('_token');
    		$all = $request->all();
        $count=CsCate::where('cate_name',$all['cate_name'])->count();
        if($count>0){
          echo json_encode(['code'=>2,'font'=>'分类名称已存在']);die;
        }
    		$data = CsCate::create($all);
    		if ($data) {
    			echo json_encode(['code'=>1,'font'=>'添加成功']);die;
    		}else{
    			echo json_encode(['code'=>2,'font'=>'添加失败']);die;
    		}
			return redirect()->back();
    	}
   		$data=CsCate::all();
   		$data=CsCate::getCateInfo($data);
   		return view('backend.cate.cateadd',['data'=>$data]);
   	}
   	//分类展示
   	public function catelist(Request $request){
   		$data=CsCate::all();
   		$list=CsCate::getCateInfo($data);
   		return view('backend.cate.catelist',['list'=>$list]);
   	}
    //删除分类 
    public function catedel(Request $request){
      $cate_id=request()->get('cate_id');
      //检查此类是否有子类
      $where=[
        ['parent_id','=',$cate_id]
      ];  
      $count=CsCate::where($where)->count();
      if($count>0){
          echo ("<script>alert('分类下面有子类或商品信息不能删除');location='/cate/catelist'</script>");
          exit;
      }
      $res=CsCate::where('cate_id',$cate_id)->delete();
      if($res){
         return redirect("cate/catelist");
      }

    }
    //修改分类
    public function cateupdate(Request $request){
      $data=CsCate::all();
      $data=CsCate::getCateInfo($data);
      $cate_id=request()->get('cate_id');
      $list=CsCate::where('cate_id',$cate_id)->first();

      return view('backend.cate.cateupdate',['data'=>$data,'list'=>$list]);
    }
    public function cateedit(Request $request){
        
        $data = $request->except('_token');
        $all = $request->all();
        $count=CsCate::where('cate_name',$all['cate_name'])->count();
        if($count>0){
          echo ("<script>alert('分类名称已存在');location='/cate/catelist'</script>");
          exit;
        }
        $res=CsCate::where('cate_id',$all['cate_id'])->update($data);
        if($res){
            return redirect("/cate/catelist");
        }
    }
}
