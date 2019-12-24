<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        //创建一个查询构造器 $lookup;
        $lookup = Product::query()->where('on_sale', true);

        //判断搜索框是否有搜索
        if($search = $request->input('search','')){
            $like = '%'.$search.'%';

            $lookup->where(function($query) use ($like){
                $query->where('title','like',$like)
                    ->orwhere('description','like',$like)
                    ->orwhereHas('skus',function ($query) use ($like){
                       $query->where('title','like',$like)
                            ->orwhere('description','like',$like);
                    });
            });
        }

        //判断排序方式
        if($order = $request->input('order','')){
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $lookup->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $lookup->paginate(8);
        return view('products.index', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }

    public function edible(Request $request){

        //创建一个查询构造器 $lookup;
        $lookup = Product::query()->where('on_sale', true)
                                ->where('edible',true);

        //判断搜索框是否有搜索
        if($search = $request->input('search','')){
            $like = '%'.$search.'%';

            $lookup->where(function($query) use ($like){
                $query->where('title','like',$like)
                    ->orwhere('description','like',$like)
                    ->orwhereHas('skus',function ($query) use ($like){
                        $query->where('title','like',$like)
                            ->orwhere('description','like',$like);
                    });
            });
        }

        //判断排序方式
        if($order = $request->input('order','')){
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $lookup->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $lookup->paginate(8);
        return view('products.edible', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }

    public function daily_use(Request $request)
    {
        //创建一个查询构造器 $lookup;
        $lookup = Product::query()->where('on_sale', true)
                                ->where('daily_use',true);

        //判断搜索框是否有搜索
        if($search = $request->input('search','')){
            $like = '%'.$search.'%';

            $lookup->where(function($query) use ($like){
                $query->where('title','like',$like)
                    ->orwhere('description','like',$like)
                    ->orwhereHas('skus',function ($query) use ($like){
                        $query->where('title','like',$like)
                            ->orwhere('description','like',$like);
                    });
            });
        }

        //判断排序方式
        if($order = $request->input('order','')){
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $lookup->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $lookup->paginate(8);
        return view('products.daily_use', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }

    public function wash_rinse(Request $request)
    {
        //创建一个查询构造器 $lookup;
        $lookup = Product::query()->where('on_sale', true)
            ->where('wash_rinse',true);

        //判断搜索框是否有搜索
        if($search = $request->input('search','')){
            $like = '%'.$search.'%';

            $lookup->where(function($query) use ($like){
                $query->where('title','like',$like)
                    ->orwhere('description','like',$like)
                    ->orwhereHas('skus',function ($query) use ($like){
                        $query->where('title','like',$like)
                            ->orwhere('description','like',$like);
                    });
            });
        }

        //判断排序方式
        if($order = $request->input('order','')){
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $lookup->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $lookup->paginate(8);
        return view('products.wash_rinse', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }
}
