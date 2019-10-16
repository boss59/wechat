@extends('layout.layui')

@section('title')
    素材 添加
@endsection


@section('content')
<marquee><h2><font color="blue">上传素材</font></h2></marquee>
<form  action="{{ url('/wechat/type_do') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="layui-table" >
        <tr>
            <td>资源</td>
            <td>
                <select name="type" width="300">
                    <option value="image">图片</option>
                    <option value="thumb">缩略图</option>
                    <option value="video">视频</option>
                    <option value="voice">音频</option>
                </select>
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                上传：<input type="file" name="resource">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <input type="submit" value="立即上传">
            </td>
        </tr>
    </table>
</form>
@endsection
