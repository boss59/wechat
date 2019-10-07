<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>商城&nbsp;&nbsp;&nbsp;@yield('title')</title>
<base href="/static/weui/" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="Write an awesome description for your new site here. You can edit this line in _config.yml. It will appear in your document head meta (for Google search results) and in your feed.xml site description.
">
<link rel="stylesheet" href="lib/weui.min.css">
<link rel="stylesheet" href="css/jquery-weui.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body ontouchstart>


<!-- 主体 -->
@yield('content')



<!--底部导航-->
@section('sidebar')
<div class="foot-black"></div>
<div class="weui-tabbar wy-foot-menu">
  <a href="/weui/index" class="weui-tabbar__item weui-bar__item--on">
    <div class="weui-tabbar__icon foot-menu-home"></div>
    <p class="weui-tabbar__label">首页</p>
  </a>
  <a href="/weui/cate" class="weui-tabbar__item">
    <div class="weui-tabbar__icon foot-menu-list"></div>
    <p class="weui-tabbar__label">分类</p>
  </a>
  <a href="/weui/cart" class="weui-tabbar__item">
    <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;"></span>
    <div class="weui-tabbar__icon foot-menu-cart"></div>
    <p class="weui-tabbar__label">购物车</p>
  </a>
  @if(session('userinfo')['user_id'])
  <a href="/weui/mine" class="weui-tabbar__item">
    <div class="weui-tabbar__icon foot-menu-member"></div>
    <p class="weui-tabbar__label">我的</p>
  </a>
  @else
  <a href="/weui/Login" class="weui-tabbar__item">
    <div class="weui-tabbar__icon foot-menu-member"></div>
    <p class="weui-tabbar__label">登陆</p>
  </a>
  @endif
</div>
@show
</body>
</html>
