@extends('weui.layout')

@section('title')
购物车
@endsection

@section('content')
<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">购物车</div>
</header>
@if($goods)
@foreach($goods as $k=>$v)
 <div class="weui-content">
  <div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd"><span>江苏蓝之蓝旗舰店</span><a href="javascript:;" class="wy-dele" goods_id="{{ $v->goods_id }}"></a></div>
    <div class="weui-panel__bd">
      <div class="weui-media-box_appmsg pd-10">
        <div style="padding:10px;">
          <input type="checkbox" class="box" value="{{ $v->goods_id }}">
        </div>
        <div class="weui-media-box__hd"><a href="/weui/proinfo"><img class="weui-media-box__thumb" src="{{ $v->goods_img }}"></a></div>
        <div class="weui-media-box__bd">
          <h1 class="weui-media-box__desc">
            <a href="/weui/proinfo" class="ord-pro-link"></a>
            {{ $v->goods_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{ $v->goods_desc }}
          </h1>
          <p class="weui-media-box__desc">规格：<span>红色</span>，<span>23</span></p>
          <div class="clear mg-t-10">
            <div class="wy-pro-pri fl">¥<em class="num font-15">{{ $v->goods_price }}</em></div>
            <div class="pro-amount fr">
                {{ $v->buy_number }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endforeach
@endif
<!--底部导航-->
@section('sidebar')
<div class="foot-black"></div>
<div class="weui-tabbar wy-foot-menu">
  <div class="npd cart-foot-check-item weui-cells_checkbox allselect">
    <label class="weui-cell allsec-well weui-check__label" for="all">
        <div class="weui-cell__hd">
          <input type="checkbox" class="weui-check all" name="all-sec" id="all">
          <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
          <p class="font-14">全选</p>
        </div>
    </label>
  </div>
  <button class="red-color npd w-90 t-c delxx">清空购物车</button>
  <div class="weui-tabbar__item  npd">
    <p class="cart-total-txt">合计：<i>￥</i><em class="num font-16" id="zong1">0.00</em></p>
  </div>
  <a href="javascript:void(0)" class="red-color npd w-90 t-c" id="con">
    <p class="promotion-foot-menu-label">去结算</p>
  </a>
</div>
@endsection
<script src="lib/jquery-2.1.4.js"></script> 
<script src="lib/fastclick.js"></script> 
<script type="text/javascript" src="js/jquery.Spinner.js"></script>
<script src="js/jquery-weui.js"></script>
<script>
// ================= 复选 框  单选===========
$(document).on('click','.box',function(){
  // 获取 商品总价
  getTotal();
})
//================= <!---全选按钮--> ==================
$(document).on('click','.all',function(){
  $('.box').prop('checked',$(this).prop('checked'));
  // 获取 商品总价
  getTotal();
});
// =====================  删除 ========================
  $(document).on("click",".wy-dele",function() {
    var _this = $(this);
    $.confirm("您确定要把此商品从购物车删除吗?", "确认删除?", function() {
      var goods_id = _this.attr('goods_id');
      // alert(goods_id);return;
      $.ajax({
          url:"/weui/del",//请求地址
          type:'post',//请求的类型
          dataType:'json',//返回的类型
          data:{goods_id:goods_id},//要传输的数据
          success:function(res){ //成功之后回调的方法
            // alert(res);
              if (res.code==1) {
                window.location.reload();
                $.toast("商品已经删除!");
              }else{
                alert(res.font);
              }
          }
        })
      // 获取 商品总价
      getTotal();
    }, function() {
      //取消操作
    }); 
  });
//=============       批删     ==================
$(document).on('click','.delxx',function(){
  var _this = $(this);
  $.confirm("您确定要把此商品从购物车删除吗?", "确认删除?", function() {
    var odj = $('.box:checked');
    var arr = new Array();// 定义数组
    // 循环 odj
    $.each(odj,function(){
      var id = $(this).val();
      arr.push(id);// 把id 放到数组中
    })
    // 发送请求
    $.ajax({
      url:"/weui/alldel",//请求地址
      type:'get',//请求的类型
      dataType:'json',//返回的类型
      data:{goods_id:arr},//要传输的数据
      success:function(res){ //成功之后回调的方法
        if (res.code==1) {
          window.location.reload();
          $.toast("商品已经删除!");
        }else{
          alert(res.font);
        }
      }
    })
    // 获取 商品总价
    getTotal();
  }, function() {
    //取消操作
  }); 
})
// ========================= 方法 =======================================
// 获取 商品总价
function getTotal()
{
  var box = $('.box:checked');
  if (box.length == 0) {
    alert('至少选一件商品！');return;
  }
  var goods_id = '';
  box.each(function(index){
      goods_id+=$(this).val()+',';
  })
  goods_id=goods_id.substr(0,goods_id.length-1);
  // 发送 ajax
  $.ajax({
      url:'/weui/total',//请求地址
      type:'POST',//请求的类型
      // dataType:'json',//返回的类型
      data:{goods_id:goods_id},//要传输的数据
      success:function(res){ //成功之后回调的方法
          // alert(res);
          // console.log(res);
          $('#zong1').text('￥'+res);
          
      }
    })
}
// ============ 确认结算 =========
$(document).on('click','#con',function(){
    var box = $('.box:checked');
    if (box.length == 0) {
      alert('至少选一件商品！');return;
    }
    var goods_id = '';
    box.each(function(index){
        goods_id+=$(this).val()+',';
    })
    goods_id=goods_id.substr(0,goods_id.length-1);
    // alert(goods_id);return;
    location.href = "/weui/orderinfo?goods_id="+goods_id;
})
</script>
@endsection
