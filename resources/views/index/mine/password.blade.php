@extends('weui.layout')

@section('title')
    会员中心
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">密码修改</div>
</header>
<div class="weui-content">
    <div class="weui-cells cardlist">
        <a class="weui-cell weui-cell_access" href="/weui/psd_chage">
            <div class="weui-cell__bd"><p>登陆密码修改</p></div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="/weui/psd_chage">
            <div class="weui-cell__bd"><p>交易密码修改</p></div>
            <div class="weui-cell__ft"></div>
        </a>
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