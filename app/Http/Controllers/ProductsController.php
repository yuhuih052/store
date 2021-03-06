<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exceptions\RequestException;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;
use App\Models\OrderItem;

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

        $products = $lookup->paginate(18);
        return view('products.index', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }

    public function edible(Request $request){

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

        $products = $lookup->paginate(12);
        return view('products.edible', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }

    public function daily_use(Request $request)
    {
        $lookup = Product::query()->where('on_sale', true)
                                ->where('daily_use',true);

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

        $products = $lookup->paginate(12);
        return view('products.daily_use', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }

    public function wash_rinse(Request $request)
    {
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

        $products = $lookup->paginate(12);
        return view('products.wash_rinse', ['products' => $products, 'filters'  => ['search' => $search, 'order'  => $order,],]);
    }

    public function details(Request $request, Product $product)
    {
        //判断商品是否上架
        if(!$product->on_sale){
            throw new RequestException('商品未上架');
        }

        $favored = false;

        if($user = $request->user()){
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }

        $reviews = OrderItem::query()
            ->with(['order.user', 'productSku']) // 预先加载关联关系
            ->where('product_id', $product->id)
            ->whereNotNull('reviewed_at') // 筛选出已评价的
            ->orderBy('reviewed_at', 'desc') // 按评价时间倒序
            ->limit(10) // 取出 10 条
            ->get();

        return view('products.details',['product'=>$product,'favored'=>$favored,'reviews'=>$reviews]);
    }

    public function favor(Request $request, Product $product){

        $user = $request->user();

        if($user->favoriteProducts()->find($product->id)){

            return;

        }
        $user->favoriteProducts()->attach($product->id);

        return;
    }

    public function disfavor(Request $request, Product $product){

        $user = $request->user();

        $user->favoriteProducts()->detach($product->id);

        return;
    }

    public function favorites(Request $request){

        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites',['products'=>$products]);
    }


}
