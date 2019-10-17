@extends('layout.layui')

@section('title')
    素材 展示
@endsection


@section('content')
    <div align="center">
        <marquee><h2><span class="label label-info">素材列表</span></h2></marquee>
    </div>
    <div align="center">
    <form action="/wechat/resource_list" method="get">
        <input type="button" name="image" value="图片" class="btn btn-danger">
        <input type="button" name="thumb" value="缩略图" class="btn btn-primary">
        <input type="button" name="video" value="视频" class="btn btn-warning">
        <input type="button" name="voice" value="音频" class="btn btn-info">
    </form>
    </div>
<table border="1" class="layui-table">
    <tr>
        <td>编号</td>
        <td>media_id</td>
        <td>类型</td>
        <td>路径</td>
        <td>时间</td>
        <td>操作</td>
    </tr>
  @foreach($data as $k=>$v)
    <tr>
        <td>{{ $v['tid'] }}</td>
        <td>{{ $v['media_id'] }}</td>
        <td>{{ $v['type'] }}</td>
        <td><a href="{{ $v['path'] }}">点击查看</a></td>
        <td>{{ date("Y-m-d H:i:s",$v['add_time']) }}</td>
        <td>
            <a href="/wechat/download?media_id={{ $v['media_id'] }}&type={{ $v['type'] }}&path={{ $v['path'] }}">资源下载</a> ||
            <a href="">删除</a> ||
            <a href="">修改</a>
        </td>
    </tr>
  @endforeach
</table>
@endsection

