@extends('weui.layout')

@section('title')
    余额充值
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">余额充值</div>
</header>
<div class="weui-content">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">充值金额</label></div>
            <div class="weui-cell__bd"><input class="weui-input" type="number" placeholder="请输入金额"></div>
        </div>
    </div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">微信支付</a>
    </div>

</div>
@endsection
@section('sidebar')
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
