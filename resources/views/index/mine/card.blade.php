@extends('weui.layout')

@section('title')
    会员中心
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">银行卡管理</div>
</header>
<div class="weui-content">
    <div class="weui-cells cardlist">
        <a class="weui-cell weui-cell_access card-opt" href="javascript:;">
            <div class="weui-cell__bd"><p>622202******35754</p></div>
            <div class="weui-cell__ft">工商银行</div>
        </a>
        <a class="weui-cell weui-cell_access card-opt" href="javascript:;">
            <div class="weui-cell__bd"><p>622202******35754</p></div>
            <div class="weui-cell__ft">民丰银行</div>
        </a>
    </div>
    <div class="weui-btn-area">
        <a href="/weui/add_card" class="weui-btn weui-btn_plain-default">+添加银行卡</a>
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