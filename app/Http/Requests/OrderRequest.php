<?php

namespace App\Http\Requests;


use App\Models\ProductSku;
use Illuminate\Validation\Rule;

class OrderRequest extends Request
{

    public function rules()
    {
        return [
            // 判断用户提交的地址 ID 是否存在于数据库并且属于当前用户
            'address_id'    =>  ['required',Rule::exists('user_addresses','id')->where('user_id',$this->user()->id)],
            'items'         =>  ['required','array'],
            'items.*.sku_id'=>  [
                'required',
                function($attribute,$value,$fail){

                    if(!$sku = ProductSku::find($value)){
                        $fail('商品不存在');
                        return;
                    }
                    if(!$sku->product->on_sale){
                        $fail('商品未上架');
                        return;
                    }
                    if(!$sku->stock === 0){
                        $fail('商品已售完');
                        return;
                    }
                    // 获取当前索引
                    preg_match('/items\.(\d+)\.sku_id/', $attribute, $m);
                    $index  = $m[1];
                    // 根据索引找到用户所提交的购买数量
                    $amount = $this->input('items')[$index]['amount'];
                    if ($amount > 0 && $amount > $sku->stock) {
                        $fail('该商品库存不足');
                        return;
                    }
                },
            ],
            'items.*.amount' => ['required', 'integer', 'min:1'],
        ];
    }
}
