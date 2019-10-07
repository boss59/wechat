@extends('weui.layout')

@section('title')
分类
@endsection

@section('content')
<!--顶部搜索-->
<!--主体-->
    <div class="wy-content">
    <div class="category-top">
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
    </div>
            <aside>
                <div class="menu-left scrollbar-none" id="sidebar">
                    <ul>
                        @foreach($list as $v)
                            <li class="active abc" sort_id="{{ $v->cate_id }}">
                                {{ $v->cate_name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        @foreach($list as $v)
            @foreach($v->son as $vv)
                <section class="menu-right padding-all j-content" parent_id="{{ $v->cate_id }}">
                    <h5>
                        <a href="/weui/prolist?cate_id={{ $vv->cate_id }}">{{ $vv->cate_name }}</a>
                    </h5>
                    <ul>
                        @foreach($vv->son as $vvv)
                        <li class="w-3">
                            <a href="/weui/prolist?cate_id={{ $vvv->cate_id }}">
                            <!-- <img src="upload/pro3.jpg" > -->
                            <span>{{ $vvv->cate_name }}</span></a>
                        </li>
                        @endforeach
                    </ul>

                </section>
            @endforeach
        @endforeach
</div>
<script src="/jq.js"></script>
    <script>
        $(function () {
            $(".active").nextAll().removeClass("active");
            $(document).on("click",".abc",function () {
                $(this).siblings().removeClass("active");
                $(this).addClass("active");
                sort();
            })
            function sort() {
                var sort_id=$(".active").attr('sort_id');
                var section=$("section");
                section.each(function (index) {
                    $(this).removeClass("aaa");
                    if(sort_id!=$(this).attr("parent_id")){
                        $(this).addClass("aaa");
                    }
                })
            }
        })
    </script>
    <style>
        .aaa{
            display:none;
        }
    </style>
@endsection
