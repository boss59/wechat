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
      <th>名称</th>
      <th>网址</th>
      <th>图片</th>
      <th>是否展示</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    @foreach($list as $v) 
    <tr>
      <td>{{ $v->brand_id }}</td>
      <td>{{ $v->brand_name }}</td>
      <td><img src="{{ $v->brand_brand }}"></td>
      <td>
      {{ $v->brand_show }}</td>
      <td><a href="/brand/branddel?brand_id={{ $v->brand_id }}">删除</a>
          <a href="/brand/brandupdate?brand_id={{ $v->brand_id }}">修改</a>
      </td>
    </tr>
     @endforeach 
  </tbody>
</table>
@endsection