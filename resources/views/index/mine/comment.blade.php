@extends('weui.layout')

@section('title')
    发表评价
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">发表评价</div>
</header>
<div class="weui-content clear">
    <div class="order-list-Below clear">
        <h1>商品评价</h1>
        <ul>
            <li class="on"></li>
            <li class="on"></li>
            <li class="on"></li>
            <li class="on"></li>
            <li class="on"></li>
        </ul>
    </div>
    <div class="weui-cells weui-cells_form com-txt-area">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea txt-area" placeholder="这个商品满足你的期待吗？说说你的使用心得，分享给想买的他们吧" rows="3"></textarea>
                <div class="weui-textarea-counter font-12 num"><span>0</span>/200</div>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_checkbox commg">
        <label class="weui-cell weui-check__label" for="s11">
            <div class="weui-cell__hd">
                <input type="checkbox" class="weui-check" name="checkbox1" id="s11" checked="checked">
                <i class="weui-icon-checked"></i>
            </div>
            <div class="weui-cell__bd"><p>匿名评价</p></div>
        </label>
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title font-14">图片上传</p>
                        <div class="weui-uploader__info font-12">0/2</div>
                    </div>
                    <div class="weui-uploader__bd">
                        <ul class="weui-uploader__files" id="uploaderFiles">
                            <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
                                <div class="weui-uploader__file-content">50%</div>
                            </li>
                        </ul>
                        <div class="weui-uploader__input-box">
                            <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" multiple="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="com-button"><a href="javascript:void(0);">发表评价</a></div>
</div>
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
<script type="text/javascript">
    $(".order-list-Below ul li").click(
        function(){
            var num = $(this).index()+1;
            var len = $(this).index();
            var thats = $(this).parent(".order-list-Below ul").find("li");
            if($(thats).eq(len).attr("class")=="on"){
                if($(thats).eq(num).attr("class")=="on"){
                    $(thats).removeClass();
                    for (var i=0 ; i<num; i++) {
                        $(thats).eq(i).addClass("on");
                    }
                }else{
                    $(thats).removeClass();
                    for (var k=0 ; k<len; k++) {
                        $(thats).eq(k).addClass("on");
                    }
                }
            }else{
                $(thats).removeClass();
                for (var j=0 ; j<num; j++) {
                    $(thats).eq(j).addClass("on");
                }
            }
        }
    );
</script>

@endsection