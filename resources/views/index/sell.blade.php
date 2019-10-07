@extends('weui.layout')

@section('title')
商家 入注流程
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">商家入驻流程</div>
</header>
<div class="weui-content">
  <article class="weui-article">
    <section class="wy-news-info">
      <p>
        <img src="images/ruzhuliucheng.jpg" alt="">
      </p>
      <p class="t-c font-13">微信暂不支持商家入驻，请到PC端操作</p>
    </section>
  </article>
  
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
