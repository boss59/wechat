@extends('weui.layout')

@section('title')
微信 支付
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">订单详情</div>
</header>
<form action="/weui/confirmOrder" method="post">
<input type="hidden" name="goods_id" value="{{$goods_id}}">
<div class="weui-content">
<!-- 地址 -->
  <div class="wy-media-box weui-media-box_text address-select">
    <div class="weui-media-box_appmsg">
      <div class="weui-media-box__hd proinfo-txt-l" style="width:20px;"><span class="promotion-label-tit"><img src="images/icon_nav_city.png" /></span></div>
      <div class="weui-media-box__bd">
      @foreach($address as $k=>$v)
        <a href="/weui/address_list" class="weui-cell_access">
          <input type="hidden" name="address_id" value="{{ $v['address_id'] }}">
          <h4 class="address-name"><span>{{ $v['consignee'] }}</span><span>{{ $v['mobile'] }}</span></h4>
          {{ $v['province'] }}&nbsp;&nbsp;{{ $v['city'] }}&nbsp;&nbsp;{{ $v['district'] }}&nbsp;&nbsp;{{ $v['address'] }}
          <div class="address-txt"></div>
        </a>
      @endforeach
      </div>
      <div class="weui-media-box__hd proinfo-txt-l" style="width:16px;"><div class="weui-cell_access"><span class="weui-cell__ft"></span></div></div>
    </div>
  </div>
<!-- 商品 -->
  <div class="wy-media-box weui-media-box_text">
    <div class="weui-media-box__bd">
    @foreach($goods as $k=>$v)
      <div class="weui-media-box_appmsg ord-pro-list">
        <div class="weui-media-box__hd"><a href="/weui/proinfo"><img class="weui-media-box__thumb" src="{{ $v->goods_img }}" ></a></div>
        <div class="weui-media-box__bd">
          <h1 class="weui-media-box__desc"><a href="pro_info.html" class="ord-pro-link">{{ $v->goods_name }}</a></h1>
          <p class="weui-media-box__desc">规格：<span>红色</span>，<span>23</span></p>
          <div class="clear mg-t-10">
            <div class="wy-pro-pri fl">¥<em class="num font-15">{{ $v->goods_price }}</em></div>
            <div class="pro-amount fr"><span class="font-13">数量×<em class="name">{{ $v->buy_number }}</em></span></div>
          </div>
        </div>
      </div>
    @endforeach
    
    </div>
  </div>
  <div class="weui-panel">
    <div class="weui-panel__bd">
      <div class="weui-media-box weui-media-box_small-appmsg">
        <div class="weui-cells">
          <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd weui-cell_primary">
            <input type="hidden" name="pay_id" value="1">
            <input type="hidden" name="shipping_id" value="1">
            <input type="hidden" name="goods_amount" value="{{ $total }}">
            <input type="hidden" name="pay_status" value="0">
            <input type="hidden" name="order_status" value="0">
            <input type="hidden" name="shipping_status" value="0">
            <input type="hidden" name="zipcode" value="66889">
            <input type="hidden" name="tel" value="1368884328">
            <input type="hidden" name="email" value="2792593650@qq.com">
            <input type="hidden" name="best_time" value="早上 9:00">
            <input type="hidden" name="sign_building" value="竞技场">
            <input type="hidden" name="shipping_fee" value="3312">
              <p class="font-14"><span class="mg-r-10">配送方式</span><span class="fr">申通快递</span></p>
            </div>
          </div>
          <div class="weui-cell weui-cell_access" href="javascript:;">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">运费</span><span class="fr txt-color-red">￥<em class="num">10.00</em></span></p>
            </div>
          </div>
          <a class="weui-cell weui-cell_access" href="money.html">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">可用蓝豆</span><span class="sitem-tip"><em class="num">1235</em>个</span></p>
            </div>
            <span class="weui-cell__ft"></span>
          </a>
          <a class="weui-cell weui-cell_access" href="coupon.html">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">优惠券</span><span class="sitem-tip"><em class="num">0</em>张可用</span></p>
            </div>
            <span class="weui-cell__ft"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="wy-media-box weui-media-box_text">
    <div class="mg10-0 t-c">总金额：<span class="wy-pro-pri mg-tb-5">¥<em class="num font-20">{{ $total }}</em></span></div>
    <div class="mg10-0">
      <input type="submit" class="weui-btn weui-btn_primary" value="支付"> 
    </div>
  </div>
</div>
</form>
@section('sidebar')
@endsection
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