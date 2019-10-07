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
			height: 40px;
			width: 80px;
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
		#addBtn{
			float: right;
			display: block;
			width: 200px;
			height: 40px;
			background: #539a30;
			border: none;
			outline: none;
			text-align: center;
			text-decoration: none;
			line-height: 40px;
			color: #fff;
			margin-top: 10px;
			border-radius: 4px;
		}
	</style>

<marquee><h2><font style color='blue'>每一个不甘离开，都是为了最后的归来！！！</font></h2></marquee>


	<form action="/admin/useradd" method="post">
	@csrf
		<table align="center" border="1" cellpadding="0" cellspacing="0"> 
				<td>姓名：</td>
				<td>
					<input type="text" name="name">
				</td>
			</tr>
			<tr>
				<td>性别：</td>
				<td>
					<select name="sex" >
						<option value="1">男</option>
						<option value="2">女</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>年龄：</td>
				<td>
					<input type="text" name="age">
				</td>
			</tr>
			<tr>
				<td>会员：</td>
				<td>
					<select name="status" >
						<option value="1">普通会员</option>
						<option value="2">高级会员</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>简介：</td>
				<td>
					<textarea name="desc" cols="30" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<button type="submit">添加</button>
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