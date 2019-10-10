<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户信息</title>
</head>
<body>
<marquee><h2><font style color='blue'>每一个不甘离开，都是为了最后的归来！！！</font></h2></marquee>
<table border="1" align="center">
    <tr>
        <td align="center">头像</td>
        <td align="center">名</td>
        <td align="center">账号</td>
        <td align="center">性别</td>
        <td align="center">国家</td>
        <td align="center">省</td>
        <td align="center">市</td>
        <td align="center">时间</td>
    </tr>
    @foreach($info as $v)
        <tr>
            <td align="center"><img src="{{ $v['headimgurl'] }}" alt="" width="100"></td>
            <td align="center">{{ $v['nickname'] }}</td>
            <td align="center">{{ $v['openid'] }}</td>
            <td align="center">@if($v['sex']==1)男@else女@endif</td>
            <td align="center">{{ $v['country'] }}</td>
            <td align="center">{{ $v['province'] }}</td>
            <td align="center">{{ $v['city'] }}</td>
            <td align="center">{{ date("Y:m:d H:i:s",$v['subscribe_time']) }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>