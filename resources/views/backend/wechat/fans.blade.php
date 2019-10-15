@extends('layout.layui')

@section('title')
    粉丝列表
@endsection


@section('content')
    <div>
        <marquee><h2><font color='blue'>粉丝列表</font></h2></marquee>
    </div>
    <form action="{{ url('/wechat/addsign') }}" method="post">
        <input type="hidden" name="id" value="{{ $id }}">
    <table class="layui-table">
        <thead>
            <tr>
                <th>编号</th>
                <th>openid：</th>
                <th>用户名：</th>
                <th>性别：</th>
                <th>头像：</th>
                <th>地区：</th>
                <th>关注时间：</th>
                <th>所属标签：</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $k=>$v)
            <tr>
                <td align="center"><input type="checkbox" name="openid_list[]" value="{{ $v['openid'] }}"></td>
                <td align="center">{{ $v['openid'] }}</td>
                <td align="center">{{ $v['nickname'] }}</td>
                <td align="center">@if($v['sex']==1)男@else女@endif</td>
                <td align="center"><img src="{{ $v['headimgurl'] }}" alt="" width="50"></td>
                <td align="center"> {{ $v['country']  }} {{ $v['province'] }} {{ $v['city']  }}</td>
                <td align="center">{{ date("Y:m:d H:i:s",$v['subscribe_time']) }}</td>
                <td align="center"><a href="/wechat/tagsign?openid={{ $v['openid'] }}">查看所属标签</a></td>
            </tr>
        @endforeach
        </tbody>
        @if(isset($id))
            <tr>
                <td colspan="8" align="center">
                    <input type="submit"  class="btn btn-primary sign" value="立即提交">
                    <input type="button"  class="btn btn-danger" value="取消标签" id="but">
                    <input type="button"  class="btn btn-danger" value="模板消息" id="push">
                </td>
            </tr>
        @else
            <span>到底了</span>
        @endif
    </table>
    </form>
    {{-- 取消标签--}}
    <script>
        $(function(){
            $(document).on('click','#but',function(){
                var _this = $(this);
                var odj = $('[name="openid_list[]"]:checked');
                var id = $('[name="id"]').val();
                // alert(id);return;
                var arr = new Array();// 定义数组
                // 循环 odj
                $.each(odj,function(){
                    var id = $(this).val();
                    arr.push(id);// 把id 放到数组中
                })
                $.ajax({
                    url:"/wechat/delfans",//请求地址
                    type:'get',//请求的类型
                    dataType:'json',//返回的类型
                    data:{openid:arr,id:id},//要传输的数据
                    success:function(res){ //成功之后回调的方法

                    }
                })
            })
            $(document).on('click','#push',function(){
                var odj = $('[name="openid_list[]"]:checked');
                var arr = new Array();// 定义数组
                // 循环 odj
                $.each(odj,function(){
                    var id = $(this).val();
                    arr.push(id);// 把id 放到数组中
                });
                $.ajax({
                    url:"/wechat/pushmsg",//请求地址
                    type:'get',//请求的类型
                    dataType:'json',//返回的类型
                    data:{openid:arr},//要传输的数据
                    success:function(res){ //成功之后回调的方法
                        alert("发送成功");
                    }
                })
            })
        })
    </script>
@endsection

