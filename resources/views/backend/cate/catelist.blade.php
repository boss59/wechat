@extends('layout.layui')

@section('title')
品牌 添加
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
      <th>分类名</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    @foreach($list as $v) 
    <tr>
      <td>{{ $v->cate_id }}</td>
     <td>
        {!! str_repeat('&nbsp;&nbsp;',$v['level']*3) !!}
        {{ $v->cate_name }}
        </td>
      <td>
          <a href="/cate/catedel?cate_id={{ $v->cate_id }}">删除</a>
          <a href="/cate/cateupdate?cate_id={{ $v->cate_id }}">修改</a>
      </td>
    </tr>
     @endforeach 
  </tbody>
</table>
@endsection
