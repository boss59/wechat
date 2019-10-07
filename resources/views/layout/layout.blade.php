<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ env('APP_NAME') }}&nbsp;&nbsp;&nbsp;@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/img.js') }}"></script>
</head>
<body>
<!-- 顶部导航栏 -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <marquee>
  	<button type="button" class="btn btn-danger dropdown-toggle">欢迎登陆</button>
  </marquee>
<!-- 商标 -->
<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img alt="Brand" src="/static/blogs/images/u=451768886,1785690773&fm=26&gp=0.jpg" width="100" height="80">
      </a>
    </div>
</div>
<!-- 信息 -->
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ env('App_NAME') }}</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">主页 <span class="sr-only">(current)</span></a></li>
        <li><a href="#">相册</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;小屋
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <!-- 搜索 -->
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="沐雨橙风">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>
      <!-- 信息 -->
      <ul class="nav navbar-nav navbar-right">
      	<button type="button" class="btn btn-default" aria-label="Left Align">
		  <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
		</button>
        <div class="btn-group" role="group" aria-label="...">
		  <button type="button" class="btn btn-default">首页</button>
		  <button type="button" class="btn btn-default">文章</button>
		  <button type="button" class="btn btn-default">动态</button>
		  <button type="button" class="btn btn-default">留言</button>
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
		</div>
        <div class="btn-group">
		  <button type="button" class="btn btn-danger">归档</button>
		  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    <span class="caret"></span>
		    <span class="sr-only">Toggle Dropdown</span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a href="#">Action</a></li>
		    <li><a href="#">Another action</a></li>
		    <li><a href="#">Something else here</a></li>
		    <li role="separator" class="divider"></li>
		    <li><a href="#">Separated link</a></li>
		  </ul>
		</div>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>

<!-- 大的banner -->
<div class="alert alert-danger" role="alert">
<div class="jumbotron" style="margin-top: 100px;">
  <div class="container">
    <h2>电子商务</h2>
  	<div class="col-sm-6 col-md-5">
    <div class="thumbnail">
      <img alt="Brand" src="/static/blogs/images/u=659969810,1432627535&fm=11&gp=0.jpg" >
      <div class="caption">
        <p>你总会站上巅峰，回首来的路都值得！！！</p>
        <p><a href="#" class="btn btn-primary" role="button">进入</a> <a href="#" class="btn btn-default" role="button">查看</a></p>
      </div>
    </div>
  </div>

  <p>有人十年征程孤军奋斗，有人南山墓底寂寞长眠。</p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">进入主页</a></p>
  </div>
</div>
</div>


<!-- <div class="container"> -->
	<div class="row">
		<!-- 左边菜单栏 -->
		<div class="col-md-3 col-sm-6">
			@section('slide')
			<div class="list-group">
			  <a href="#" class="list-group-item list-group-item-success">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  			管理列表
			  </a>
			  <a href="#" class="list-group-item list-group-item-info">
				<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				导航菜单
			  </a>

			  <span class="list-group-item list-group-item-warning">
				<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				文章管理 <span class="caret"></span></span>
	  			<ul class="dropdown-menu">
				    <li><a href="/blogs/articleadd">文章添加</a></li>
				    <li><a href="/blogs/index">文章展示</a></li>
			  	</ul>
			  </span>

			  <span class="list-group-item list-group-item-success">
				<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
				&nbsp;&nbsp;&nbsp;&nbsp;
	  			<span class="btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				留言管理 <span class="caret"></span></span>
	  			<ul class="dropdown-menu">
				    <li><a href="#">留言添加</a></li>
				    <li><a href="#">留言展示</a></li>
			  	</ul>
			  </span>

			  <span class="list-group-item list-group-item-danger">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
				&nbsp;&nbsp;&nbsp;&nbsp;
	  			<span class="btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				评论管理 <span class="caret"></span></span>
	  			<ul class="dropdown-menu">
				    <li><a href="#">评论添加</a></li>
				    <li><a href="#">评论展示</a></li>
			  	</ul>
			  </span>

			  <span class="list-group-item list-group-item-success">
				<span class="glyphicon glyphicon-film" aria-hidden="true"></span>
				&nbsp;&nbsp;&nbsp;&nbsp;
	  			<span class="btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				图片管理 <span class="caret"></span></span>
	  			<ul class="dropdown-menu">
				    <li><a href="/blogs/imgadd">图片添加</a></li>
				    <li><a href="/blogs/imglist">图片展示</a></li>
			  	</ul>
			  </span>
			</div>
			@show
		</div>
	<!-- 内容 展示 -->
		<div class="col-md-9">
			@yield('content')
		</div>
	</div>
<!-- </div> -->

</body>
</html>