@extends('layout.layui')

@section('title')
品牌 添加
@endsection


@section('content')
<form class="layui-form" action="/goods/goodsadd" method="post" style="margin: 50px ;" id="form" enctype="multipart/form-data">
@csrf
<div class="layui-form-item">
    <label class="layui-form-label">商品名</label>
    <div class="layui-input-block">
      <input type="text" name="goods_name" required  lay-verify="required" placeholder="请输入商品名" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品金额</label>
    <div class="layui-input-block">
      <input type="text" name="goods_price" required  lay-verify="required" placeholder="请输入商品金额" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品图片</label>
    <div class="layui-input-block">
      <input type="file" name="goods_img" required  lay-verify="required" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品数量</label>
    <div class="layui-input-block">
      <input type="text" name="goods_num" required  lay-verify="required" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品描述</label>
    <div class="layui-input-block">
     <textarea name="goods_desc"></textarea>
    </div>
  </div>
   <div class="layui-form-item">
    <label class="layui-form-label">是否上架</label>
    <div>
      <input type="radio" name="is_up" value="1" >是
      <input type="radio" name="is_up" value="2">否
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">是否新品</label>
    <div>
      <input type="radio" name="is_new" value="1" >是
      <input type="radio" name="is_new" value="2">否
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">是否精品</label>
    <div>
      <input type="radio" name="is_sell" value="1" >是
      <input type="radio" name="is_sell" value="2">否
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">是否热门</label>
    <div>
      <input type="radio" name="is_show" value="1" >是
      <input type="radio" name="is_show" value="2">否
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">品牌</label>
    <div class="layui-input-block">
      <select name="brand_id">
          <?php  foreach($list as $k=>$v) : ?>
          <option value="{{ $v->brand_id }}">
          {{ $v->brand_name }}</option>
          <?php endforeach ?>
      </select>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">分类</label>
    <div class="layui-input-block">
      <select name="cate_id">
          <?php  foreach($data as $v) : ?>
          <option value="{{ $v->cate_id }}">
          {!! str_repeat('&nbsp;&nbsp;',$v['level']*3) !!}
          {{ $v->cate_name }}</option>
          <?php endforeach ?>
      </select>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <input type="submit" class="layui-btn" value="添加" >
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