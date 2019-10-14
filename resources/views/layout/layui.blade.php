<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>全职后台</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('layui/layui.all.js') }}"></script>
  <script src="{{ asset('layui/layui.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.mobile.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}">
  <script src="{{ asset('js/img.js') }}"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">
     <img src="/static/blogs/images/u=432034140,1026580416&fm=26&gp=0.jpg" width="70" height='40'>全职&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;高手
    </div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;控制台</a>
      </li>
      <li class="layui-nav-item"><a href="">
          <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;商品管理</a></li>
      <li class="layui-nav-item"><a href="">
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;邮件管理</a></dd>
          <dd><a href="">
            <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;消息管理</a></dd>
          <dd><a href="">
            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="/static/blogs/images/u=3078949319,1903067204&fm=26&gp=0.jpg" class="layui-nav-img" width="50" height="50">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;基本资料</a></dd>
          <dd><a href="">
          <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;安全设置</a></dd>
        </dl>
      </li>
       @guest
        <button type="button" class="btn btn-default"><a href="{{ route('login') }}">登陆</a></button>
      @endguest
      @auth
         <div class="btn-group">
          <button type="button" class="btn btn-primary">{{ Auth::user()->name }}</button>
          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="/blogs/logout">注销</a>
            </li>
          </ul>
      </div>
      @endauth
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      @section('slide')
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="label label-info" href="javascript:;">
            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;&nbsp;
          管理员</a>
          <dl class="layui-nav-child">
            <dd><a href="/admin/useradd">
            <span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>&nbsp;&nbsp;
            管理员添加</a></dd>
            <dd><a href="/admin/userlist">
              <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;&nbsp;
            管理员列表</a></dd>
          </dl>
        </li>

        {{-- 用户管理 --}}
        <li class="layui-nav-item layui-nav-itemed">
          <a class="label-info" href="javascript:;">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;
            用户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/wechat/signindex">
                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;&nbsp;
                标签列表</a></dd>
            <dd><a href="/wechat/fans">
                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;&nbsp;
                粉丝列表</a></dd>
          </dl>
        </li>

        <li class="layui-nav-item layui-nav-itemed">
          <a class="label label-info" href="javascript:;">
            <span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>&nbsp;&nbsp;
          品牌管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/brand/brandadd">
            <span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>&nbsp;&nbsp;
            品牌添加</a></dd>
            <dd><a href="/brand/brandlist">
              <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;&nbsp;
            品牌列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item layui-nav-itemed">
          <a class="label label-info" href="javascript:;">
            <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>&nbsp;&nbsp;
          分类管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/cate/cateadd">
              <span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>&nbsp;&nbsp;
            分类添加</a></dd>
            <dd><a href="/cate/catelist">
              <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;&nbsp;
            分类列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item layui-nav-itemed">
          <a class="label label-info" href="javascript:;">
            <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>&nbsp;&nbsp;
          商品管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/goods/goodsadd">
            <span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>&nbsp;&nbsp;
            商品添加</a></dd>
            <dd><a href="/goods/goodslist">
            <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;&nbsp;
            商品列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item layui-nav-itemed">
          <a class="label label-info" href="javascript:;">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;
            角色管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/admin/roleadd">
            <span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>&nbsp;&nbsp;
            角色添加</a></dd>
            <dd><a href="/admin/rolelist">
              <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;&nbsp;
            角色列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="javascript:;">
         <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>&nbsp;&nbsp;
        云市场</a></li>
        <li class="layui-nav-item"><a href="javascript:;">
        <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>&nbsp;&nbsp;
        发布商品</a></li>
      </ul>
      @show
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    @yield('content')
  </div>
  
  <div class="layui-footer" >
    <!-- 底部固定区域 -->
   <p align="center">
        <marquee><h2><font color="blue">每一个不甘离开，都是为了最后的归来！！！</font></h2></marquee>
   </p>
  </div>
</div>
<script src="/layui/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
});
</script>
</body>
</html>