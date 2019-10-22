@extends('layout.layui')

@section('title')
    二维码 生成
@endsection


@section('content')
    <div align="center">
        <marquee><h2><span class="label label-info">二维码 生成</span></h2></marquee>
    </div>
    <table border="1" class="layui-table">
        <tr>
            <td>编号</td>
            <td>openid</td>
            <td>用户名</td>
            <td>图片</td>
            <td>推广数量</td>
            <td>二维码</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td>{{ $v['user_id'] }}</td>
                <td>{{ $v['openid'] }}</td>
                <td>{{ $v['phone'] }}</td>
                <td><img src="{{ asset($v['qrcode_url']) }}" width="100" height="100"></td>
                <td>{{ $v['share_num'] }}</td>
                <td><a href="/wechat/add_code?user_id={{ $v['user_id'] }}">生成二维码</a></td>
            </tr>
        @endforeach
    </table>
@endsection
