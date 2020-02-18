<?php

namespace App\Http\Controllers;

use App\Models\CouponCode;
use Carbon\Carbon;
use App\Exceptions\CouponCodeUnavailableException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponCodesController extends Controller
{
    public function show($code, Request $request)
    {
        // 判断优惠券是否存在
        if (!$record = CouponCode::where('code', $code)->first()) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        //优惠券存在就调用优惠券模型类里面的检查方法进行验证
        $record->checkAvailable($request->user());

        return $record;
    }

    public function index(){
        $coupon_codes = DB::table('coupon_codes')->get()->where('enabled', 1);

        return view('coupon_codes',['coupon_codes'=>$coupon_codes,]);
    }
}
