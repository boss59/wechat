@extends('weui.layout')

@section('title')
推荐 专场
@endsection

@section('content')
<!--顶部搜索-->
<header class='weui-header fixed-top'>
  <div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form">
      <input type="hidden" name="cate_id" value="{{ $cateids }}">
      <input type="hidden" name="is_sell" value="{{ $is_sell }}">
      <div class="weui-search-bar__box">
        <i class="weui-icon-search"></i>
        <input type="search" class="weui-search-bar__input" id="search" placeholder="搜索您想要的商品" required>
        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
      </div>
      <label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
        <i class="weui-icon-search"></i>
        <span>搜索您想要的商品</span>
      </label>
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
  </div>
  <div class="pro-sort">
    <div class="weui-flex">
      <div class="weui-flex__item logo">
        <div class="placeholder NormalCss goods" type="2" field="goods_id" is_sell='1'>
          <span>默认</span>
          <span class="upDown">↑</span>
        </div>
      </div>
      <div class="weui-flex__item logo">
        <div class="placeholder NormalCss snum " type="2" field="goods_num" is_sell='1'>
          <span>按销量</span>
          <span class="upDown">↑</span>
        </div>
      </div>
      <div class="weui-flex__item logo">
        <div class="placeholder NormalCss price" type="2" field="goods_price" is_sell='1'>
          <span>按价格</span>
          <span class="upDown">↑</span>
        </div>
      </div>
      <div class="weui-flex__item">
        <div class="placeholder NormalCss price" type="2" field="goods_price">
          <span>全部</span>
        </div>
      </div>
    </div>
  </div>
</header>
<!--主体-->
<div class="weui-content" style="padding-top:85px;">
  <!--产品列表滑动加载-->
  <div class="weui-pull-to-refresh__layer">
    <div class='weui-pull-to-refresh__arrow'></div>
    <div class='weui-pull-to-refresh__preloader'></div>
    <div class="down">下拉刷新</div>
    <div class="up">释放刷新</div>
    <div class="refresh">正在刷新</div>
  </div>

  <div id="list" class='demos-content-padded proListWrap'>
  @foreach($goods as $k=>$v)
    <div class="pro-items">
      <a href="/weui/proinfo?goods_id={{ $v->goods_id }}" class="weui-media-box weui-media-box_appmsg">
        <div class="weui-media-box__hd"><img class="weui-media-box__thumb" src="{{ $v->goods_img }}" alt=""></div>
        <div class="weui-media-box__bd">
          <h1 class="weui-media-box__desc">{{ $v->goods_name }}</h1>
          <h1 class="weui-media-box__desc">{{ $v->goods_desc }}</h1>
          <div class="wy-pro-pri">¥<em class="num font-15">{{ $v->goods_price }}</em></div>
          <ul class="weui-media-box__info prolist-ul">
            <li class="weui-media-box__info__meta"><em class="num">0</em>条评价</li>
            <li class="weui-media-box__info__meta"><em class="num">100%</em>好评</li>
          </ul>
        </div>
      </a>
    </div>
  @endforeach
  </div>
  <div class="weui-loadmore">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">正在加载</span>
  </div>
 
</div>
<script src="lib/jquery-2.1.4.js"></script> 
<script src="lib/fastclick.js"></script> 
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script> 
<script src="js/jquery-weui.js"></script>
<script>
    $(document.body).pullToRefresh().on("pull-to-refresh", function() {
      setTimeout(function() {
        $("#time").text(new Date);
        $(document.body).pullToRefreshDone();
      }, 2000);
    });
</script>
<script>
$(function(){
    // id
    $(document).on('click','.goods',function(){
        var _this = $(this);
        getinfo(_this)
    })
    // 库存
    $(document).on('click','.snum',function(){
        var _this = $(this);
        getinfo(_this)
    })
    // 价格
    $(document).on('click','.price',function(){
        var _this = $(this);
        getinfo(_this)
    })
    //给搜索框绑定键盘抬起事件
    $(document).on("keyup","#search",function () {
        //调用like方法处理
        var _this = $(this);
        getinfo(_this);
    })
    // 方法
    function getinfo(_this)
    {
        // 2 如果 得到排序 变化 箭头
        var field = _this.attr('field');
        var type = _this.attr('type');
        var name=_this.val();
        var cateids = $('input[name="cate_id"]').attr('value');
        var is_sell = $('input[name="is_sell"]').attr('value');
        // alert(is_sell);
        if (type == 2) {
           var _text = _this.find('span[class="upDown"]').text();
           // alert(_text);return;
           if(_text == '↑'){
                var new_text = '↓';
                var order = 'desc';
           }else{
                var new_text = '↑';
                var order = 'asc';
           }
           _this.find('span[class="upDown"]').text(new_text);
        }
        $.ajax({
            url:'/weui/progoods',//请求地址
            type:'post',//请求的类型
            // dataType:'json',//返回的类型
            data:{field:field,order:order,cateids:cateids,is_sell:is_sell,name,name},//要传输的数据
            success:function(res){ //成功之后回调的方法
                // alert(res);
                $('#list').html(res);
            }
        })
    }
    
})
</script>
@endsection