@extends('layouts.app')
@section('title', '商品列表')

@section('content')
    <nav class="col-lg-12">
        <ul class="nav nav-tabs col-lg-12" style="margin: 10px">
            <li role="presentation"><a href="{{route('products.index')}}">首页</a></li>
            <li role="presentation"><a href="{{route('products.edible')}}">食品酒水</a></li>
            <li role="presentation"><a href="{{route('products.daily_use')}}">生活用品</a></li>
            <li role="presentation" class="active"><a href="#">美妆个护</a></li>
            <li role="presentation"><a href="{{route('coupon_codes.index')}}">领券</a></li>
        </ul>
        <!-- 筛选组件开始 -->
        <div class="row">
            <form action="{{ route('products.index') }}" class="form-inline search-form">
                <input type="text" class="form-control input-sm" name="search" placeholder="搜索">
                <button class="btn btn-primary btn-sm">搜索</button>
                <select name="order" class="form-control input-sm pull-right">
                    <option value="">排序方式</option>
                    <option value="price_asc">价格从低到高</option>
                    <option value="price_desc">价格从高到低</option>
                    <option value="sold_count_desc">销量从高到低</option>
                    <option value="sold_count_asc">销量从低到高</option>
                    <option value="rating_desc">评价从高到低</option>
                    <option value="rating_asc">评价从低到高</option>
                </select>
            </form>
        </div>
        <!-- 筛选组件结束 -->
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row products-list">
                        @foreach($products as $product)
                            <div class="col-xs-2 product-item">
                                <a style="text-decoration: none;" target="_Blank" href="{{route('products.details',['product'=>$product->id])}}">
                                <div class="product-content">
                                    <div class="top">
                                        <div class="img" style="height: 163px;"><img src="{{ $product->image_url }}" alt="" style="height: auto;"></div>
                                        <div class="price"><b>￥</b>{{ $product->price }}</div>
                                        <div class="title">{{ $product->title }}</div>
                                    </div>
                                    <div class="bottom">
                                        <div class="sold_count">销量 <span>{{ $product->sold_count }}笔</span></div>
                                        <div class="review_count">评价 <span>{{ $product->review_count }}</span></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="pull-right">{{ $products->appends($filters)->render() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsAfterJs')
    <script>
        var filters = {!! json_encode($filters) !!};
        $(document).ready(function () {
            $('.search-form input[name=search]').val(filters.search);
            //监听下拉事件
            $('.search-form select[name=order]').on('change', function() {
                $('.search-form').submit();
            });
        })
    </script>
@endsection