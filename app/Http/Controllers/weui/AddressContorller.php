<?php

namespace App\Http\Controllers\weui;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weui\AreaModels;
use App\Weui\AddressModels;
class AddressContorller extends Controller
{
    public function area(Request $request)
    {
        //获取省级
        $area = new AreaModels;
        $top = $area->where('pid',0)->get();
        return view('index.address.address_edit',['top'=>$top]);
    }
    // ajax 山及联动
    public function getArea(Request $request)
    {
        $area = new AreaModels;

        $id = $request->get('id');
        if(!$id)
        {
            return;
        }
        $data = $area->where('pid',$id)->get()->tojson();
        echo $data;
    }
    //添加收货人
    public function addAddress(Request $request)
    {
        if($request->isMethod("POST")){
            $all = $request->except('_token');
            $all['user_id'] = session("userinfo")['user_id'];
            // dd($all);
            if (!empty($all['is_deff'])) {
                AddressModels::where('user_id',$user_id)->update(['is_deff'=>0]);
            }
            $res = AddressModels::create($all);
            if($res)
            {
                echo json_encode(['ret'=>1,'msg'=>'添加成功']);
            }else{
                echo json_encode(['ret'=>2,'msg'=>'添加失败']);

            }
        }
    }
    //收货人展示
    public function address_list(Request $request)
    {
        $AddressModels = new AddressModels();
        $area = new AreaModels;
        $all = $AddressModels->get();
        foreach($all as $k=>$v){
            $city = $v->city;
            $arr=$area->where('id',$city)->first();
            $all[$k]->city=$arr['name'];
            $province = $v->province;
            $arr=$area->where('id',$province)->first();
            $all[$k]->province=$arr['name'];
            $district = $v->district;
            $arr=$area->where('id',$district)->first();
            $all[$k]->district=$arr['name'];
        }

        return view('index.address.address_list',['all'=>$all]);
    }
    // 设置默认
    public function deff(Request $request)
    {
        $address_id = $request->input('address_id');
        $user_id = session('userinfo')['user_id'];
        $where=[
            'user_id'=>$user_id,
            'address_id'=>$address_id,
        ];
        $address = AddressModels::where('user_id',$user_id)->update(['is_deff'=>0]);
        $res = AddressModels::where($where)->update(['is_deff'=>1]);
        if ($res) {
            echo json_encode(['code'=>1,'font'=>'设置成功']);
        }else{
            echo json_encode(['code'=>0,'font'=>'添加失败']);
        }
    }












    // 第一次 添加 地址
    public function addorder(Request $request)
    {
        $address = $request->input('address');
        // dd($address);
        //获取省级
        $area = new AreaModels;
        $top = $area->where('pid',0)->get();
        if($request->isMethod('POST')){
            $data = $request->input();
            unset($data['addess']);
            // var_dump($data);exit;
            $data['user_id'] = session("userinfo")['user_id'];
            $res = AddressModels::create($data);
            if ($res) {
                echo json_encode(['ret'=>1,'msg'=>'添加成功']);die;
            }else{
                echo json_encode(['ret'=>2,'msg'=>'添加失败']);die;
            }
        }
        return view('index.order.addorder',['top'=>$top,'address'=>$address]);
    }
}
