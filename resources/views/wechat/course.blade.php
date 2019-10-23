<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>课程管理</title>
</head>
<body>
<center>
<form action="/wechat/index_course" method="post">
@csrf
    <input type="hidden" name="openid" value="{{ $openid }}">
<table border="1">
    <tr>
        <td>第一节：</td>
        <td>
            <select name="one">
                <option value="php">php</option>
                <option value="语文">语文</option>
                <option value="数学">数学</option>
                <option value="英语">英语</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>第二节：</td>
        <td>
            <select name="twe">
                <option value="php">php</option>
                <option value="语文">语文</option>
                <option value="数学">数学</option>
                <option value="英语">英语</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>第三节：</td>
        <td>
            <select name="three">
                <option value="php">php</option>
                <option value="语文">语文</option>
                <option value="数学">数学</option>
                <option value="英语">英语</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>第四节：</td>
        <td>
            <select name="four">
                <option value="php">php</option>
                <option value="语文">语文</option>
                <option value="数学">数学</option>
                <option value="英语">英语</option>
            </select>
        </td>
    </tr>
    <tr align="center">
        <td colspan="2" ><input type="submit" value="立即提交"></td>
    </tr>
</table>
</form>
</center>
</body>
</html>