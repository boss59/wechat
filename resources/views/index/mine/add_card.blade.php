@extends('weui.layout')

@section('title')
    会员中心
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">添加银行卡</div>
</header>
<div class="weui-content">
    <div class="weui-cell wy-address-edit">
        <div class="weui-cell__hd"><label for="" class="weui-label wy-lab">卡号</label></div>
        <div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" value="weui input error" placeholder="请输入卡号"></div>
        <div class="weui-cell__ft"><i class="weui-icon-warn"></i></div>
    </div>
    <div class="weui-cell wy-address-edit">
        <div class="weui-cell__hd"><label class="weui-label wy-lab">持卡人</label></div>
        <div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" placeholder="陈大鹏"></div>
    </div>
    <div class="weui-cell wy-address-edit">
        <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
        <div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" placeholder="18951263540"></div>
    </div>
    <div class="weui-btn-area">
        <a href="add_card.html" class="weui-btn weui-btn_plain-default">保存此银行卡</a>
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
<script>
    $(document).on("click", ".card-opt", function() {
        $.actions({
            actions: [
                {
                    text: "删除",
                    className: 'bg-danger',
                }
            ]
        });
    });
</script>
@endsection
