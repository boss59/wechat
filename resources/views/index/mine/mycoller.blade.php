@extends('weui.layout')

@section('title')
我的 收藏
@endsection

@section('content')
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">我的收藏</div>
</header>
<!--主体-->
<div class="weui-content">
  <div class='proListWrap'>
  @foreach($coller as $k=>$v)
    <div class="pro-items">
      <div class="weui-media-box weui-media-box_appmsg">
        <div class="weui-media-box__hd"><a href="/weui/proinfo?goods_id={{ $v->goods_id }}"><img class="weui-media-box__thumb" src="{{ $v->goods_img }}" alt=""></a></div>
        <div class="weui-media-box__bd">
          <h1 class="weui-media-box__desc"><a href="/weui/proinfo?goods_id={{ $v->goods_id }}" class="ord-pro-link">
			{{ $v->goods_name }}&nbsp;&nbsp;&nbsp;&nbsp;
			{{ $v->goods_desc }}
          </a></h1>
          <div class="wy-pro-pri">¥<em class="num font-15">{{ $v->goods_price }}</em></div>
          <ul class="weui-media-box__info prolist-ul">
            <li class="weui-media-box__info__meta"><a href="javascript:;" class="wy-dele"></a></li>
          </ul>
        </div>
      </div>
    </div>
   @endforeach
  </div>
</div>



<script src="lib/jquery-2.1.4.js"></script> 
<script src="lib/fastclick.js"></script> 
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script> 
<script src="js/jquery-weui.js"></script>
</body>
</html>



@endsection