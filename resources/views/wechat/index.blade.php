@extends('layout.layui')

@section('title')
    素材 添加
@endsection


@section('content')
<marquee><h2><font color="blue">上传素材</font></h2></marquee>
<form class="layui-form" action="{{ url('/wechat/type_do') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="layui-form-item" style="padding-left:400px">
        <label class="layui-form-label">资源</label>
        <div  class="col-sm-2 control-label">
            <select name="type" lay-verify="required">
                <option value="image">图片</option>
                <option value="thumb">缩略图</option>
                <option value="video">视频</option>
                <option value="voice">音频</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item" style="padding-left:400px">
        <label class="layui-form-label">单选框</label>
        <div class="layui-input-block">
            <input type="radio" name="choose" value="1" title="零时">
            <input type="radio" name="choose" value="2" title="永久" checked>
        </div>
    </div>
    <div class="layui-form-item layui-form-text" style="padding-left:400px">
        <label class="layui-form-label">上传：</label>
        <div class="layui-input-block">
            <input type="file" name="resource">
        </div>
    </div>
    <div class="layui-form-item" style="padding-left:400px">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });
</script>
@endsection
