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
    <form action="/wechat/update_cousre" method="post">
        @csrf
        <table border="1">
            <tr>
                <td>第一节：</td>
                <td>
                    <select name="one">
                        <option value="php" @if($data["one"]=='php') selected @endif>php</option>
                        <option value="语文" @if($data["one"]=='语文') selected @endif>语文</option>
                        <option value="数学" @if($data["one"]=='数学') selected @endif>数学</option>
                        <option value="英语" @if($data["one"]=='英语') selected @endif>英语</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>第二节：</td>
                <td>
                    <select name="two">
                        <option value="php" @if($data["two"]=='php') selected @endif>php</option>
                        <option value="语文" @if($data["two"]=='语文') selected @endif>语文</option>
                        <option value="数学" @if($data["two"]=='数学') selected @endif>数学</option>
                        <option value="英语" @if($data["two"]=='英语') selected @endif>英语</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>第三节：</td>
                <td>
                    <select name="three">
                        <option value="php" @if($data["three"]=='php') selected @endif>php</option>
                        <option value="语文" @if($data["three"]=='语文') selected @endif>语文</option>
                        <option value="数学" @if($data["three"]=='数学') selected @endif>数学</option>
                        <option value="英语" @if($data["three"]=='英语') selected @endif>英语</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>第四节：</td>
                <td>
                    <select name="four">
                        <option value="php" @if($data["four"]=='php') selected @endif>php</option>
                        <option value="语文" @if($data["four"]=='语文') selected @endif>语文</option>
                        <option value="数学" @if($data["four"]=='数学') selected @endif>数学</option>
                        <option value="英语" @if($data["four"]=='英语') selected @endif>英语</option>
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