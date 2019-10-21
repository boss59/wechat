@extends('layout.layui')

@section('title')
    粉丝列表
@endsection


@section('content')
    <div>
        <marquee><h2><font color='blue'>粉丝列表</font></h2></marquee>
    </div>
    <form action="{{ url('/wechat/message') }}" method="post">
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
                <th>单发消息：</th>
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
                    <td align="center"><a href="/wechat/dan?openid={{ $v['openid'] }}">单发消息</a></td>
                </tr>
            @endforeach
            </tbody>
                <tr>
                    <td colspan="8" align="center">
                        <input type="submit"  class="btn btn-primary sign" value="群发消息">
                    </td>
                </tr>
        </table>
    </form>
@endsection

