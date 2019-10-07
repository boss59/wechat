@extends('layout.layui')

@section('title')
分类 添加
@endsection


@section('content')
<form class="layui-form" action="cateadd" method="post" id="form">
@csrf
  <div class="layui-form-item">
    <label class="layui-form-label">分类名</label>
    <div class="layui-input-block">
      <input type="text" name="cate_name" required  lay-verify="required" placeholder="请输入分类名" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">无限极分类</label>
    <div class="layui-input-block">
      <select name="parent_id">
        <option value="0">--顶级分类--</option>
          <?php  foreach($data as $v) : ?>
          <option value="{{ $v->cate_id }}">
          {!! str_repeat('&nbsp;&nbsp;',$v['level']*3) !!}
          {{ $v->cate_name }}</option>
          <?php endforeach ?>
      </select>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <input type="button" class="layui-btn" lay-submit lay-filter="formDemo" value="立即提交" id="btn">
      
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

<script>
$(document).on('click','#btn',function(){
  var form = new FormData($("#form")[0]);
    // var form = $('#form').serialize();// 序列化serialize
    // alert(form);
    $.ajax({
      url:"/cate/cateadd",
      data:form,
      type:"POST",
      dataType:'json',
      processData: false, //需设置为false。因为data值是FormData对象，不需要对数据做处理
      contentType: false, //需设置为false。因为是FormData对象，且已经声明了属性
      success:function(res){
        if (res.code == 1) {
          alert(res.font);
          location.href="/cate/catelist";
        }else{
          alert(res.font);
        }
      }
    })
})
</script>
@endsection