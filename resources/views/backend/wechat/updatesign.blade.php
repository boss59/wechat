@extends('layout.layui')

@section('title')
    标签修改
@endsection


@section('content')
<div align="center">
    <h2>标签修改</h2>
</div>
    <form class="layui-form" action="/wechat/updatesign" method="post" style="margin: 50px ;" id="form">
        <div class="layui-form-item">
            <label class="layui-form-label">标签名:</label>
            <div class="layui-input-inline">
                <input type="text" name="name" value="{{ $arr['name'] }}" required  lay-verify="required" placeholder="请输入标签名称" autocomplete="off" class="layui-input">@php echo $errors->first('brand_name')@endphp
            </div>
            <label class="layui-form-label">标签id:</label>
            <div class="layui-input-inline">
                <input type="text" name="id" value="{{ $arr['id'] }}" required  lay-verify="required" placeholder="请输入标签名称" autocomplete="off" class="layui-input">@php echo $errors->first('brand_name')@endphp
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="立即修改" id="btn">
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection
