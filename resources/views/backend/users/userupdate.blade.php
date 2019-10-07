@extends('layout.layui')

@section('title')
管理员 添加
@endsection


@section('content')

	<style>
		table{
			width: 60%;
			height: 200px;
			margin-top: 20px;
		}
		input{
			height: 30px;
			line-height: 30px;
			width: 300px;
			font-size: 16px;
			padding: 5px;
		}
		select{
			height: 20px;
			width: 50px;
		}
		button{
			width: 200px;
			height: 40px;
			line-height: 40px;
			background-color: #ef6763;
			border: none;
			outline: none;
			text-align: center;
			color: #fff;
			border-radius: 4px;
		}
	</style>

<marquee><h2><font style color='blue'>有人十年征程孤军奋斗，有人南山墓底寂寞长眠！！！</font></h2></marquee>
	<form action="/admin/userupdate" method="post">
	@csrf
	<input type="hidden" name="user_id" value="{{$info->user_id}}">
		<table align="center" border="1" cellpadding="0" cellspacing="0"> 
				<td>姓名：</td>
				<td>
					<input type="text" name="name" value="{{$info->name}}">
				</td>
			</tr>
			<tr>
				<td>性别：</td>
				<td>
					<select name="sex" >
					@if($info->sex==1)
						<option value="1" selected>男</option>
						<option value="2">女</option>
					@else
						<option value="1" >男</option>
						<option value="2" selected>女</option>
					@endif
					</select>
					
				</td>
			</tr>
			<tr>
				<td>年龄：</td>
				<td>
					<input type="text" name="age" value="{{$info->age}}">
				</td>
			</tr>
			<tr>
				<td>简介：</td>
				<td>
					<textarea name="desc" cols="30" rows="10">{{$info->desc}}</textarea>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<button type="submit">修改</button>
				</td>
			</tr>
		</table>
	</form>

<!-- 添加 -->
<script type="text/javascript">
		function post($obj){
			// alert(1);
			// 阻止默认行为
			event.preventDefault();
			// alert('1');return;
			var name = $obj.name.value;
			var sex = $obj.sex.value;
			var age = $obj.age.value;
			var desc = $obj.desc.value;
			// alert('name');return;
			if(name=="" || sex=="" || age=="" || desc==""){
				alert("信息填写不完整!");
				return false;
			}

			// 使用ajax提交
			$obj.submit();
		}
	</script>
@endsection