@extends('layout.layui')

@section('title')
品牌 展示
@endsection


@section('content')
<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>编号</th>
      <th>商品名</th>
      <th>价格</th>
      <th>商品图片</th>
      <th>商品数量</th>
      <th>是否上架</th>
      <th>是否新品</th>
      <th>是否精品</th>
      <th>是否热门</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    @foreach($list as $v) 
    <tr>
      <td>{{ $v->goods_id }}</td>
      <td>{{ $v->goods_name }}</td>
      <td>{{ $v->goods_price }}</td>
      <td><img src="{{ $v->goods_img }}"></td>
      <td>{{ $v->goods_num }}</td>
      <td>{{ $v->is_up }}</td>
      <td>{{ $v->is_new }}</td>
      <td>{{ $v->is_sell }}</td>
      <td>{{ $v->is_show }}</td>
      <td><a href="/goods/goodsdel?goods_id={{ $v->goods_id }}">删除</a>
          <a href="/goods/goodsupdate?goods_id={{ $v->goods_id }}">修改</a>
      </td>
    </tr>
     @endforeach 
  </tbody>
</table>
@endsection
