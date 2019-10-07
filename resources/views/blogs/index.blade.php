@extends('layout.layout')

@section('title')
首页
@endsection

<!-- 内容 -->
@section('content')
@if(session()->has('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif
	<table class="table table-bordered">
		<thead>
			<tr>
				<th align="center">编号</th>
				<th>标题</th>
				<th>作者</th>
				<th>描述</th>
				<th>图片</th>
				<th>发布时间</th>
				<th>修改时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>		
		@foreach($list as $v)
			<tr>
			  <td class="active">{{ $v->tid }}</td>
			  <td class="success">{{ $v->title }}</td>
			  <td class="warning">{{ $v->man }}</td>
			  <td class="active">{!! $v->content !!}</td>
			  <td class="active"><img src="{{ asset('storage/'.$v->img) }}" width="100" height="100"></td>
			  <td class="info">{{ $v->add_time }}</td>
			   <td class="info">{{ $v->update_time }}</td>
			  <td class="danger" align="center">
			  		<a href="{{ route('detail',['id'=>$v->tid]) }}">
						<button type="button" class="btn btn-success">详情</button>
					</a>
					<a href="{{ route('del',['id'=>$v->tid]) }}"> 
						<button type="button" class="btn btn-danger">删除</button>
					</a>
					<a href="{{ route('update',['id'=>$v->tid]) }}">
						<button type="button" class="btn btn-success">修改</button>
					</a>	
			  </td>
			</tr>
		@endforeach
		</tbody>	
	</table>
	{{ $list->links() }}
@endsection