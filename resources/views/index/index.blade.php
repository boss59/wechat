@extends('weui.layout')

@section('title')
首页
@endsection

@section('content')
<!--顶部搜索-->
<header class='weui-header'>
  <div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form">
      <div class="weui-search-bar__box">
        <i class="weui-icon-search"></i>
        <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索您想要的商品" required>
        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
      </div>
      <label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
        <i class="weui-icon-search"></i>
        <span>搜索您想要的商品</span>
      </label>
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
  </div>
</header>
<!--主体-->
<div class='weui-content'>
  <!--顶部轮播-->
  <div class="swiper-container swiper-banner">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><a href="pro_info.html"><img src="upload/sdf.jpg" width="100" height="260" /></a></div>
      <div class="swiper-slide"><a href="pro_list.html"><img src="upload/asd.jpg" width="100" height="260"/></a></div>
      <div class="swiper-slide"><a href="pro_info.html"><img src="upload/ccc.jpg" width="100" height="260"/></a></div>
      <div class="swiper-slide"><a href="pro_list.html"><img src="upload/qq.gif" width="100" height="260"/></a></div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <!--图标分类-->
  <div class="weui-flex wy-iconlist-box">
    <div class="weui-flex__item"><a href="/weui/prolist?is_sell=1" class="wy-links-iconlist"><div class="img"><img src="images/icon-link1.png"></div><p>精选推荐</p></a></div>
    <div class="weui-flex__item"><a href="/weui/prolist" class="wy-links-iconlist"><div class="img"><img src="images/icon-link2.png"></div><p>查看更多</p></a></div>
    @if(session('userinfo')['user_id'])
    <div class="weui-flex__item"><a href="/weui/orders" class="wy-links-iconlist"><div class="img"><img src="images/icon-link3.png"></div><p>订单管理</p></a></div>
    @else
    <div class="weui-flex__item"><a href="/weui/Login" class="wy-links-iconlist"><div class="img"><img src="images/icon-link3.png"></div><p>订单管理</p></a></div>
    @endif
    <div class="weui-flex__item"><a href="/weui/sell" class="wy-links-iconlist"><div class="img"><img src="images/icon-link4.png"></div><p>商家入驻</p></a></div>
  </div>
  <!--新闻切换-->
  <div class="wy-ind-news">
    <i class="news-icon-laba"></i>
    <div class="swiper-container swiper-news">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><a href="/weui/newinfo">热烈祝贺伟义商城成功热烈祝贺伟义商城成功上线热烈祝贺伟义商城成功上线上线</a></div>
        <div class="swiper-slide"><a href="/weui/newinfo">蓝之蓝股份成公司上市</a></div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <a href="/weui/newlist" class="newsmore"><i class="news-icon-more"></i></a>
  </div>
  <!-- 热门 -->
  <div class="wy-Module">
    <div class="wy-Module-tit"><span>热门商品</span></div>
    <div class="wy-Module-con">
      <div class="swiper-container swiper-jingxuan" style="padding-top:34px;">
        <div class="swiper-wrapper">
        @foreach($goodshow as $k=>$v)
          <div class="swiper-slide">
            <a href="/weui/proinfo?goods_id={{ $v->goods_id }}">
              <img src="{{ $v->goods_img }}" width="30" height="100" />
              <p>{{ $v->goods_name }}</p>
            </a>
          </div>
        @endforeach
        </div>
        <div class="swiper-pagination jingxuan-pagination"></div>
      </div>
    </div>
  </div>
  <!--1 楼数据-->
  <div class="wy-Module" cate_id="{{ $top->cate_id }}">
    <div class="wy-Module-tit">
      <span style="color: red;" class="num">1F</span>
      <span>{{ $top->cate_name }}</span>
    </div>
    <div class="wy-Module-con">
      <div class="swiper-container swiper-jingxuan" style="padding-top:34px;">
        <div class="swiper-wrapper">
        @foreach($goods as $k=>$v)
          <div class="swiper-slide">
            <a href="/weui/proinfo?goods_id={{ $v->goods_id }}">
              <img src="{{ $v->goods_img }}" width="30" height="100" />
              <p>{{ $v->goods_price }}</p>
              <p>{{ $v->goods_name }}</p>
            </a>
          </div>
        @endforeach
        </div>
        <div class="swiper-pagination jingxuan-pagination"></div>
      </div>
    </div>
  </div>
  <div class="morelinks"><a href="javascript:;" class="addMore" id="vv">加载更多 >></a></div>
  <!--猜你喜欢-->
  <div class="wy-Module">
    <div class="wy-Module-tit-line"><span>猜你喜欢</span></div>
    <div class="wy-Module-con">
      <ul class="wy-pro-list clear">
      @foreach($goodup as $k=>$v)
        <li>
          <a href="/weui/proinfo?goods_id={{ $v->goods_id }}">
            <div class="proimg">
              <img src="{{ $v->goods_img }}" style="height: 180px; width: 180px;">
            </div>
            <div class="protxt">
              <div class="name">{{ $v->goods_name }}</div>
              <div class="wy-pro-pri">¥<span>{{ $v->goods_price }}</span></div>
            </div>
          </a>
        </li>
      @endforeach
      </ul>
      <div class="morelinks"><a href="/weui/prolist">查看更多 >></a></div>
    </div>
  </div>
</div>

<script src="lib/jquery-2.1.4.js"></script> 
<script src="lib/fastclick.js"></script> 
<script src="/jq.js"></script> 
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script> 
<script src="js/jquery-weui.js"></script>
<script src="js/swiper.js"></script>
<script>
  $(".swiper-banner").swiper({
        loop: true,
        autoplay: 3000
      });
  $(".swiper-news").swiper({
    loop: true,
    direction: 'vertical',
    paginationHide :true,
        autoplay: 30000
      });
   $(".swiper-jingxuan").swiper({
    pagination: '.swiper-pagination',
    loop: true,
    paginationType:'fraction',
        slidesPerView:3,
        paginationClickable: true,
        spaceBetween: 2
      });
   $(".swiper-jiushui").swiper({
    pagination: '.swiper-pagination',
    paginationType:'fraction',
    loop: true,
        slidesPerView:3,
    slidesPerColumn: 2,
        paginationClickable: true,
        spaceBetween:2
      });
</script>
<!-- 楼层 数据 -->
<script>
$(function(){
    $(document).on('click','.addMore',function(){
        var _this =  $(this);
        var cate_id=_this.parents('div').prev('div').attr('cate_id');
        // alert(cate_id);
        var num = parseInt(_this.parents('div').prev('div').text());
        $.ajax({
          url:'/weui/ajaxgetFloor',//请求地址
          type:'post',//请求的类型
          // dataType:'json',//返回的类型
          data:{cate_id:cate_id,num:num},//要传输的数据
          success:function(res){ //成功之后回调的方法
            // alert(res);
            if (res==2) {
                $('#vv').text("到底了！").css('color','red');
            }else{
                _this.parent().before(res);
            }
          }
        })
    })
})

</script>
@endsection