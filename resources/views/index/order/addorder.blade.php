@extends('weui.layout')
@section("title")
    添加 地址
@endsection
@section("content")
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">编辑地址</div>
</header>
<div class="weui-content">
    <div class="weui-cells weui-cells_form wy-address-edit">
        <div class="weui-cell">
        <form action="/weui/addorder" method="post" id="form">
        <input type="hidden" name="address" value="{{ $address }}">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">收货人</label></div>
            <div class="weui-cell__bd"><input class="weui-input" name="consignee" type="text"  placeholder="收货人名称"></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
            <div class="weui-cell__bd"><input class="weui-input" name="mobile" type="tel" pattern="[0-9]*" placeholder="手机号"></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="name" class="weui-label wy-lab">地区</label></div>
                <!-- <div class="weui-cell__bd">
                <input class="weui-input" id="address" type="text" value="湖北省 武汉市 武昌区" readonly="" data-code="420106" data-codes="420000,420100,420106">
                </div> -->
                <select name="province" id="">
                    <option value="">请选择</option>
                    @foreach($top as $v)
                    <option value="{!!$v->id!!}">{!! $v->name !!}</option>
                    @endforeach
                </select>
                &nbsp;&nbsp;
                <select name="city" id="">
                    <option value="">请选择</option>
                </select>
                &nbsp;&nbsp;
                <select name="district" id="">
                    <option value="">请选择</option>
                </select>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">详细地址</label></div>
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" name="address" placeholder="请输入详情地址"></textarea>
            </div>
        </div>
        <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">设为默认地址</div>
            <div class="weui-cell__ft"><input class="weui-switch" type="checkbox"></div>
        </div>
    </div>
    <div class="weui-btn-area">
        <!-- <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">保存此地址</a> -->
        <input type="button" value="保存此地址" class="weui-btn weui-btn_primary" id="bnt">
        <a href="javascript:;" class="weui-btn weui-btn_warn">删除此地址</a>
        </form>
    </div>

</div>
<!-- 三级联动 -->
<script src="lib/jquery-2.1.4.js"></script> 
<script>
    $('select').change(function(){
        var id = $(this).val();
        var _this = $(this);
        $.get(
            "/weui/getArea",
            {id:id},
            function(msg){
               var str='<option value="">请选择</option>';
               $.each(msg,function(key,val){
                str+='<option value='+val.id+'>'+val.name+'</option>';
               });
                _this.next().html(str);               
            },'json'
        );
    })
</script>
<!-- ajax添加 -->
<script>
    $(document).on('click','#bnt',function(){
        var form = $('#form').serialize();// 序列化serialize
        $.ajax({
            url:"/weui/addorder",
            data:form,
            type:"post",
            dataType:'json',
            success:function(res){
            var aa = $('input[name="address"]').attr('value');
                if (res.ret == 1) {
                    alert(res.msg);
                    location.href = aa;
                }else{
                    alert(res.msg);
                }
            }
        })
    })
</script>
@endsection