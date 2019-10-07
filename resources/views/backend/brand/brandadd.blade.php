@extends('layout.layui')

@section('title')
品牌 添加
@endsection


@section('content')
<form class="layui-form" action="/brand/brandadd" method="post" style="margin: 50px ;" id="form" enctype="multipart/form-data">
@csrf
  <div class="layui-form-item">
    <label class="layui-form-label">名称</label>
    <div class="layui-input-inline">
      <input type="text" name="brand_name" required  lay-verify="required" placeholder="请输入品牌名称" autocomplete="off" class="layui-input">@php echo $errors->first('brand_name')@endphp
    </div>
  </div>
 
 <div class="form-group">
     <label class="layui-form-label">图片</label>
    <input type="file" class="form-control" placeholder="" name="brand_brand" style="display: none" id="upload">
    <button class="btn btn-warning" id="img" type="button" >上传图片</button>
    <div for="inputPassword3" class="col-sm-2 control-label">
        <img src="{{ asset('/static/blogs/images/imgas.jpg') }}" alt="图片" class="img-thumbnail" width="200" height="200">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">显示</label>
    <div class="layui-input-block">
      <input type="radio" name="brand_show" value="1" title="是">
      <input type="radio" name="brand_show" value="2" title="否">
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">文本域</label>
    <div class="layui-input-block">
      <textarea id="container" name="brand_desc"  class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="立即提交" id="btn">
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
<!-- 富文本 -->
<!-- 配置文件 -->
<script type="text/javascript" src="{{ asset('static/ueditor/ueditor.config.js') }}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ asset('static/ueditor/ueditor.all.js') }}"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    var content = "{!! old('content') !!}";
    ue.ready(function(){
        ue.setContent(content);
    })
</script>
<!-- ajax 添加 -->
<script>
// $(document).on('click','#btn',function(){
// 	var form = new FormData($("#form")[0]);
//     // var form = $('#form').serialize();// 序列化serialize
//     // alert(form);
//     $.ajax({
//       url:"/brand/brandadd",
//       data:form,
//       type:"POST",
//       dataType:'json',
//       processData: false, //需设置为false。因为data值是FormData对象，不需要对数据做处理
//       contentType: false, //需设置为false。因为是FormData对象，且已经声明了属性
//       success:function(res){
//         if (res.code == 1) {
//           alert(res.font);
//           location.href="/brand/brandlist";
//         }else{
//           alert(res.font);
//         }
//       }
//     })
// })
</script>
@endsection