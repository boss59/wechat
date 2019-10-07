@extends('layout.layui')

@section('title')
管理员 添加
@endsection


@section('content')
<style type="text/css">
		*{
			padding: 0px;
			margin: 0px;
		}

		.wrap{
			width: 80%;
			margin: 10px auto;
		}
		table{
			width: 100%;
			margin: 20px auto;
		}

		table tr th,table tr td{
			border: 1px solid #ddd;
			height: 30px;
			font-size: 16px;
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

		.pagination li{
			float: left;
			padding: 10px;
			list-style: none;
			border: 1px solid #ddd;
			margin-left: 10px;
		}
		#delxx{
			height: 30px;
			line-height: 30px;
			width: 300px;
			font-size: 16px;
			padding: 5px;
			color: blue;
			background-color: #ef6763;
		}
		.div{
            float: left;
            width:100%;
            background: orchid;
            height: 60px;
            line-height: 60px;
            border-radius: 10px;
        }
        .input{
            height: 10px;
            line-height: 10px;
            width: 150px;
            font-size: 14px;
            padding: 5px;
        }
        select{
            height: 30px;
        }
        .age{
         width:80px;
        }
        .search{
            width: 150px;
            height: 35px;
            background-color: lightseagreen;
            border: none;
            outline: none;
            text-align: center;
            color: #fff;
            border-radius: 4px;
        }
	</style>

<div class="wrap">
<h1>巅峰荣耀</h1>
<a href="/admin/useradd" id="addBtn">添加页面</a>
<div class="div">
        <form action="/admin/userlist" method="get">
            姓名:
            <input type="text" name="name" placeholder="学生姓名" class="input">
            年龄：
            <input type="text" name="age" class="age" placeholder="年龄" class="input">
            性别:
            <select name="sex">
                <option value="">--请选择性别--</option>
                <option value="1">男</option>
                <option value="2">女</option>
            </select>
            字段
            <select name="field" >
                <option value="">--请选择排序--</option>
                <option value="user_id">user_id</option>
                <option value="name">name</option>
                <option value="age">age</option>
                <option value="sex">sex</option>
                <option value="update_time">add_time</option>
                <option value="update_time">update_time</option>
            </select>
           排序规则
            <select name="order" >
                <option value="">--请选择--</option>
                <option value="asc">升序</option>
                <option value="desc">降序</option>
            </select>
            <input type="submit" value="搜索" class="search">
        </form>
    </div>
<marquee><h2><font style color='blue'>你终会站上巅峰，回首来的路，都值得！！！</font></h2></marquee>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>
				全<input type="checkbox" class="all">
             || 反<input type="checkbox" class="noall">
			</th>
			<th>姓名</th>
			<th>性别</th>
			<th>年龄</th>
			<th>添加时间</th>
			<th>修改时间</th>
			<th>简介</th>
			<th>操作</th>
		</tr>
	</thead>

	<tbody>
		<?php  foreach($data as $k=>$v) : ?>
		<tr user_id="{{ $v->user_id }}" >
			<td align="center">
				<input type="checkbox"  class="one">
				<font color="red">{{ $v->user_id }}</font>
			</td>
			<td align="center"><font color="blue"><?=$v->name?></font></td>
			@if($v->sex==1)
				<td align="center"><font color="red">男</font></td>
			@else
				<td align="center"><font color="red">女</font></td>
			@endif
			<td align="center"><font color="blue">{{ $v->age }}</font></td>
			<td align="center"><font color="red">{{ $v->add_time }}</font></td>
			<td align="center"><font color="blue">{{ $v->update_time }}</font></td>
			<td align="center"><font color="red">{{ $v->desc }}</font></td>

			<td align="center">
				<a href="?user_id={{ $v->user_id }}">查看</a> ||
				<a href="/admin/userupdate?user_id={{ $v->user_id }}">修改</a> ||
				<a href="/admin/userdelete?user_id={{ $v->user_id }}">删除</a> 
			</td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="8" align="center"><input type="button" value="批量删除" id="delxx"></td>
	</tr>
	</tbody>
	
</table>
{{ $data->appends($query)->links() }}
</div>
<script src=" /jq.js"></script>
<script>
// 全选 反选
$('.all').on('click',function(){
    // alert(1);
    $('.one').prop('checked',$(this).prop('checked'));
})
// 反选
$('.noall').on('click',function(){
    // alert(2);
    $('.one').prop('checked',function(i,val){
      return !val;
    });
})
// 批删
$(document).on('click','#delxx',function(){
	if (window.confirm('是否进行删除？')) {
      var aaa='';
      $(".one:checked").each(function(){
        aaa+=$(this).parents('tr').attr('user_id')+',';
      })
      aaa=aaa.substr(0,aaa.length-1);
      // alert(aaa);return;
      if (aaa=='') {
        alert("请选择要删除的商品");
        return false;
      }
      $.ajax({
        url:"/admin/userdata",//请求地址
        type:'post',//请求的类型
        dataType:'json',//返回的类型
        data:{user_id:aaa},//要传输的数据
        success:function(res){ //成功之后回调的方法
        	if (res.code==1) {
        		alert(res.font);
        		window.location.reload();
        	}else{
        		alert(res.font);
        		window.location.reload();
        	}
        }
      })
    }
})
</script>
@endsection