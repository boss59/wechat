<!DOCTYPE html>
<html>
<head>
<base href="/static/login/">
<meta charset="utf-8"/>
<title>后台登录</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="js/jquery.js"></script>
<script src="js/verificationNumbers.js"></script>
<script src="js/Particleground.js"></script>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
  //验证码
  createCode();
  //测试提交，对接程序删除即可
  $(".submit_btn").click(function(){
    location.href="index.html";
    });
});
</script>
</head>
<body>
<dl class="admin_login">
 <dt>
  <strong>全职后台管理系统</strong>
  <em>斗神&nbsp;&nbsp;&nbsp;一叶之秋</em>
 </dt>
 <form action="/admin/login" method="post">
 @csrf
 <dd class="user_icon">
  <input type="text" placeholder="账号" class="login_txtbx"/ name="user_name" id="user">
 </dd>
 <dd class="pwd_icon">
  <input type="password" placeholder="密码" class="login_txtbx" name="user_pwd" id="pwd"/>
 </dd>
 <dd class="val_icon">
  <div class="checkcode">
    <input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx">
    <canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
  </div>
  <input type="button" value="验证码核验" class="ver_btn" onClick="validate();">
 </dd>
 <dd>
  <input type="submit" value="立即登陆" class="submit_btn" id="but" />
 </dd>
 <!-- </form> -->
 <dd>
  <p>还未注册？，<a href="/admin/regist">去注册</a></p>
  <p>陕B2-20080224-1</p>
 </dd>
</dl>
</body>
</html>