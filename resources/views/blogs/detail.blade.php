@extends('layout.layout')

@section('title')
文章详情
@endsection
<!-- 内容 -->
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">文章详情</h3>
	</div>
	<div class="panel-boby">
		<table>
			<tr>
				<td>编号</td>
				<td>{{ $data->tid }}</td>
			</tr>
			<tr>
				<td>标题</td>
				<td>{{ $data->title }}</td>
			</tr>
			<tr>
				<td>作者</td>
				<td>{{ $data->man }}</td>
			</tr>
			<tr>
				<td>添加时间</td>
				<td>{{ $data->add_time }}</td>
			</tr>
			<tr>
				<td>更新时间</td>
				<td>{{ $data->update_time }}</td>
			</tr>
			<tr>
				<td>图片</td>
				<td>
					@if($data->img)
						<img src="{{ asset('storage/'.$data->img) }}" width="100" height="70">
					@else
						没有
					@endif
				</td>
			</tr>
			<tr>
				<td>内容</td>
				<td>{!! $data->content !!}</td>
			</tr>
		</table>
	</div>
</div>
	
@endsection