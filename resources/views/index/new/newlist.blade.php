@extends('weui.layout')

@section('title')
新闻 列表
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">新闻列表</div>
</header>
<div class="weui-content">
  <div class="weui-cells wy-news-list">
    <a class="weui-cell weui-cell_access" href="news_info.html">
      <div class="weui-cell__bd">
        <p>热烈祝贺伟义商城成功上线</p>
      </div>
      <div class="weui-cell__ft"></div>
     </a>
     <a class="weui-cell weui-cell_access" href="news_info.html">
      <div class="weui-cell__bd">
        <p>热烈祝贺蓝之蓝股份成功上市</p>
      </div>
      <div class="weui-cell__ft"></div>
     </a>
     <a class="weui-cell weui-cell_access" href="news_info.html">
      <div class="weui-cell__bd">
        <p>热烈祝贺伟义商城成功上线</p>
      </div>
      <div class="weui-cell__ft"></div>
     </a>
     <a class="weui-cell weui-cell_access" href="news_info.html">
      <div class="weui-cell__bd">
        <p>热烈祝贺蓝之蓝股份成功上市</p>
      </div>
      <div class="weui-cell__ft"></div>
     </a>
     <a class="weui-cell weui-cell_access" href="news_info.html">
      <div class="weui-cell__bd">
        <p>热烈祝贺蓝之蓝股份成功上市</p>
      </div>
      <div class="weui-cell__ft"></div>
     </a>
     <a class="weui-cell weui-cell_access" href="news_info.html">
      <div class="weui-cell__bd">
        <p>热烈祝贺伟义商城成功上线</p>
      </div>
      <div class="weui-cell__ft"></div>
     </a>
     <a class="weui-cell weui-cell_access" href="news_info.html">
      <div class="weui-cell__bd">
        <p>热烈祝贺蓝之蓝股份成功上市</p>
      </div>
      <div class="weui-cell__ft"></div>
     </a>
  </div>
  
</div>

<script src="lib/jquery-2.1.4.js"></script> 
<script src="lib/fastclick.js"></script> 
<script type="text/javascript" src="js/jquery.Spinner.js"></script>
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script>

<script src="js/jquery-weui.js"></script>
@endsection