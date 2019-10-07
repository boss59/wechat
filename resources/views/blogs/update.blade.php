@extends('layout.layout')

@section('title')
文章修改
@endsection

@section('content')
<form class="form-horizontal" action="/blogs/update" method="post" enctype="multipart/form-data">
@csrf
<input type="hidden" name="tid" value="{{ $info->tid }}">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" placeholder="标题" name="title" value="{{ $info->title }}" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">作者</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputPassword3" placeholder="作者" name="man"
      value="{{ $info->man }}"  required="required">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">文件上传</label>
    <input type="file" class="form-control" placeholder="" name="img" style="display: none" id="upload" value="">
    <button class="btn btn-warning" id="img" type="button" >上传图片</button>
    <div for="inputPassword3" class="col-sm-3 control-label" style="padding: 10px;">
        <img src="{{ $info->img ?  asset('storage/'.$info->img)  : asset('/static/blogs/images/imgas.jpg') }}" alt="图片" class="img-thumbnail" width="200" height="200">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
    <div class="col-sm-8">
     <textarea id="container" name="content" cols="20" rows="10"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-success" value="修改">
      <input type="reset" class="btn btn-danger" value="重置">
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
    var content = "{!! old('content') ?? $info->content ?? '' !!}";
    ue.ready(function(){
        ue.setContent(content);
    })
</script>
@endsection