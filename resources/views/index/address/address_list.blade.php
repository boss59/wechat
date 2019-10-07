@extends('weui.layout')
@section("title")
    地址展示
@endsection
@section("content")
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">地址管理</div>
</header>
<div class="weui-content">
    <div class="weui-panel address-box">
        <div class="weui-panel__bd">
            @foreach($all as $v)
            <div class="weui-media-box weui-media-box_text address-list-box">
                <a href="/weui/uparea" class="address-edit"></a>
                <h4 class="weui-media-box__title"><span>{{ $v->consignee }}</span> <span>{{ $v->mobile }}</span></h4>
                <p class="weui-media-box__desc address-txt">{{ $v->province }} {{ $v->city }} {{ $v->district }} </p>
                <p class="weui-media-box__desc address-txt">{{ $v->address }}</p>
                @if($v->is_deff==1)
                <span class="default-add">默认地址</span>
                @else
                <span class="default-add deff" address_id="{{ $v->address_id }}">未默认</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" href="/weui/area" id="showTooltips">添加收货地址</a>
        <a href="javascript:;" class="weui-btn weui-btn_warn">删除此地址</a>
    </div>
</div>
@endsection
<script src="/jq.js"></script>
<script>
$(document).on('click','.deff',function(){
    var address_id =$(this).attr('address_id');
    // alert(address_id);
    var _this = $(this);
    $.ajax({
        url:"/weui/deff",
        data:{address_id:address_id},
        type:"POST",
        dataType:'json',
        success:function(res){
         // alert(res);
        if(res.code==1){
            alert(res.font);
            window.location.reload();
        }else{
            alert(res.font);
        }
     }
    })

})
</script>
