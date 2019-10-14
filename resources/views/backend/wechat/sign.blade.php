@extends('layout.layui')

@section('title')
    标签添加
@endsection


@section('content')
    <form class="layui-form" action="/wechat/sign" method="post" style="margin: 50px ;" id="form">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">标签名:</label>
            <div class="layui-input-inline">
                <input type="text" name="sign_name" required  lay-verify="required" placeholder="请输入标签名称" autocomplete="off" class="layui-input">@php echo $errors->first('brand_name')@endphp
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="立即提交" id="btn">
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection
