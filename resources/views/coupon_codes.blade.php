@extends('layouts.app')
@section('title', '领取优惠码')

@section('content')
<div class="card mt-4">
    <div class="card-body pt-2">
        <div class="text-center mt-1 mb-0 text-muted">优惠券列表</div>
        <hr class="mt-2 mb-3">

            <table class="table table-bordered">

                <tr>
                    <th>名称</th>
                    <th>优惠码</th>
                    <th>描述</th>
                    <th>已使用量/总量</th>
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
                </tr>
                @endforeach
            </table>
    </div>
</div>
@endsection