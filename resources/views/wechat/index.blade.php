<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>上传素材</title>
</head>
<body>
<marquee><h2><font color="blue">上传素材</font></h2></marquee>
<form action="{{ url('/wechat/resource_do') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table border="1" align="center" width="300" height="200">
        <tr>
            <td>资源</td>
            <td>
                <select name="type">
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
</body>
</html>