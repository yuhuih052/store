@extends('layouts.app')
@section('title', '领取优惠码')

@section('content')
<div class="card mt-4">
    <nav class="col-lg-12">
    <ul class="nav nav-tabs col-lg-12" style="margin: 10px">
        <li role="presentation"><a href="{{route('products.index')}}">首页</a></li>
        <li role="presentation"><a href="{{route('products.edible')}}">食品酒水</a></li>
        <li role="presentation" ><a href="{{route('products.daily_use')}}">生活用品</a></li>
        <li role="presentation"><a href="{{route('products.wash_rinse')}}">美妆个护</a></li>
        <li role="presentation"class="active"><a href="#">领券</a></li>
    </ul>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="card-body pt-2">
                        <!--<div class="text-center mt-1 mb-0 text-muted">优惠券列表</div>
                        <hr class="mt-2 mb-3">-->
                        <table class="table table-bordered">
                            <tr>
                                <th>名称</th>
                                <th>优惠码</th>
                                <th>描述</th>
                                <th>已使用量/总量</th>
                                <th>过期时间</th>
                            </tr>
                            @foreach ($coupon_codes as $coupon_code)
                                <tr>
                                    <td>{{ $coupon_code->name }}</td>
                                    <td>{{ $coupon_code->code }}</td>
                                    @if( $coupon_code -> type == 'fixed')
                                        <td>满{{ $coupon_code->min_amount }} 优惠{{$coupon_code->value}}元</td>
                                    @else
                                        <td>满{{ $coupon_code->min_amount }} 优惠{{$coupon_code->value}}%</td>
                                    @endif
                                    <td>{{ $coupon_code->used }} / {{$coupon_code->total }}</td>
                                    @if($coupon_code->not_after != null)
                                        <td>{{$coupon_code->not_after}}</td>
                                    @else
                                        <td>无期限</td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection