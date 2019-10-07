<div class="wy-Module" cate_id="{{ $top->cate_id }}">
    <div class="wy-Module-tit">
      <span style="color: red;" class="num">{{ $num }}F</span>
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
<script>
   $(".swiper-jingxuan").swiper({
    pagination: '.swiper-pagination',
    loop: true,
    paginationType:'fraction',
        slidesPerView:3,
        paginationClickable: true,
        spaceBetween: 2
      });
</script>