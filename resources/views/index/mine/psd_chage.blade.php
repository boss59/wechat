@extends('weui.layout')

@section('title')
    密码修改
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">密码修改</div>
</header>
<div class="weui-content">
    <div class="weui-cells weui-cells_form wy-address-edit">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">新密码</label></div>
            <div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入新密码"></div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
            <div class="weui-cell__bd"><input class="weui-input" type="tel" placeholder="请输入手机号"></div>
            <div class="weui-cell__ft"><button class="weui-vcode-btn">获取验证码</button></div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">验证码</label></div>
            <div class="weui-cell__bd"><input class="weui-input" type="number" placeholder="请输入验证码"></div>
            <div class="weui-cell__ft"><img class="weui-vcode-img" src="/static/weui//images/vcode.jpg"></div>
        </div>
    </div>
    <div class="weui-btn-area"><a href="javascript:;" class="weui-btn weui-btn_primary">确认修改</a></div>
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