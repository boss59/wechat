@extends('layout.layui')

@section('title')
品牌 添加
@endsection


@section('content')
<form class="layui-form" action="/brand/brandupdatel" method="post" style="margin: 50px ;" >
  <input type="hidden" name="brand_id" value="{{ $list->brand_id }}">
@csrf
  <div class="layui-form-item">
    <label class="layui-form-label">名称</label>
    <div class="layui-input-inline">
      <input type="text" name="brand_name" value="{{ $list->brand_name }}" required  lay-verify="required" placeholder="请输入品牌名称" autocomplete="off" class="layui-input">
    </div>
  </div>
 
 <div class="form-group">
     <label class="layui-form-label">图片</label>
    <input type="file" class="form-control" placeholder="" name="brand_logo" style="display: none" id="upload">
    <button class="btn btn-warning" id="img" type="button" >上传图片</button>
    <div for="inputPassword3" class="col-sm-2 control-label">
        <img src="{{ asset('/static/blogs/images/imgas.jpg') }}" alt="图片" class="img-thumbnail" width="200" height="200">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">显示</label>
    <div class="layui-input-block">
    @if($list->is_show)
      <input type="radio" name="is_show" value="1" title="是" checked>
      <input type="radio" name="is_show" value="2" title="否">
    @else
      <input type="radio" name="is_show" value="1" title="是" >
      <input type="radio" name="is_show" value="2" title="否" checked>
    </div>
    @endif
  </div>
 <!--  <div class="layui-form-item">
    <label class="layui-form-label">排序</label>
    <div class="layui-input-inline">
      <input type="text" name="sort_order" required  lay-verify="required" placeholder="请输入排序" autocomplete="off" class="layui-input">
    </div>
  </div> -->
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">文本域</label>
    <div class="layui-input-block">
      <textarea id="container" name="brand_desc"  class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <input type="submit" class="layui-btn" value="修改" >
    </div>
  </div>
</form>

<!-- 富文本 -->
<!-- 配置文件 -->
<script type="text/javascript" src="{{ asset('static/ueditor/ueditor.config.js') }}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ asset('static/ueditor/ueditor.all.js') }}"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    var content = "{!! old('content') ?? $list->brand_desc ?? '' !!}";
    ue.ready(function(){
        ue.setContent(content);
    })
</script>

@endsection