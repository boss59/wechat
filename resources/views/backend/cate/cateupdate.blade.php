@extends('layout.layui')

@section('title')
品牌 修改
@endsection


@section('content')
<form class="layui-form" action="/cate/cateedit"  method="post" id="form">
  <input type="hidden" name="cate_id" value="{{ $list->cate_id }}">
@csrf
  <div class="layui-form-item">
    <label class="layui-form-label">分类名</label>
    <div class="layui-input-block">
      <input type="text" name="cate_name" value="{{ $list->cate_name }}" required  lay-verify="required" placeholder="请输入分类名" autocomplete="off" class="layui-input">
    </div>
  </div>
 <div class="layui-form-item">
    <label class="layui-form-label">无限极分类</label>
    <div class="layui-input-block">
      <select name="parent_id">
        <option value="0">--顶级分类--</option>
      @foreach ($data as $k => $v)
              @if ($list->parent_id==$v->cate_id)
              <option value="{{$v->cate_id}}" selected>
              {{$v->cate_name}}
              </option>
              @else
              <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
              @endif
      @endforeach
         
        
      </select>
  </div> 
  <div class="layui-form-item">
    <div class="layui-input-block">
      <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="修改" id="btn">
      
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