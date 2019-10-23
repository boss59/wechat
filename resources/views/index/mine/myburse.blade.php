@extends('weui.layout')

@section('title')
    小金库
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">小金库</div>
</header>
<div class="weui-content">
    <div class="weui-panel">
        <div class="weui-panel__hd">账户余额</div>
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title">￥<em class="num">800.0</em></h4>
                <p class="weui-media-box__desc">账户余额由银行卡充值或者伟义商城发售的充值，可以购买商品和提现。</p>
                <ul class="weui-media-box__info">
                    <li class="weui-media-box__info__meta">可提现金额：￥<em class="num">300.0</em></li>
                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">返现金额：￥<em class="num">500.0</em></li>
                </ul>
            </div>
        </div>
        <div class="weui-panel__ft">
            <a href="/weui/chongzhi" class="weui-cell weui-cell_access weui-cell_link">
                <div class="weui-cell__bd">余额充值</div>
                <span class="weui-cell__ft"></span>
            </a>
        </div>
        <div class="weui-panel__ft">
            <a href="tixian.html" class="weui-cell weui-cell_access weui-cell_link">
                <div class="weui-cell__bd">余额提现</div>
                <span class="weui-cell__ft"></span>
            </a>
        </div>
    </div>
    <div class="weui-panel">
        <div class="weui-panel__hd">待返还金额</div>
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title">￥<em class="num">500.0</em></h4>
                <p class="weui-media-box__desc">待返还金额为伟义商城发布的充值返现活动所产生，可购买商品不能提现。</p>
                <ul class="weui-media-box__info">
                    <li class="weui-media-box__info__meta">每月返现￥<em class="num">100.0</em></li>
                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">共<em class="num">5</em>个月</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="weui-panel">
        <div class="weui-panel__hd">蓝豆</div>
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title"><em class="num">165</em>个</h4>
                <p class="weui-media-box__desc">购买商品，评价订单以及参加商城的活动可获得，蓝豆可以直接购买商品。</p>
            </div>
        </div>
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