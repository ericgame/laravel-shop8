<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Exceptions\InvalidRequestException;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::query()->where('on_sale', true)->paginate(16);

        // 創建一個查詢構造器
        $builder = Product::query()->where('on_sale', true);

        // 判斷是否有提交 search 參數，如果有就賦值給 $search 變量
        // search 參數用來模糊搜索商品
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';

            // 模糊搜索商品標題、商品詳情、SKU 標題、SKU描述
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }

        // 是否有提交 order 參數，如果有就賦值給 $order 變量
        // order 參數用來控製商品的排序規則
        if ($order = $request->input('order', '')) {
            // 是否是以 _asc 或者 _desc 結尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的開頭是這 3 個字符串之一，說明是一個合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根據傳入的排序值來構造排序參數
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $builder->paginate(16);

        return view('products.index', [
            'products' => $products,
            'filters'  => [
                'search' => $search,
                'order' => $order,
            ],
        ]);
    }

    public function show(Product $product, Request $request)
    {
        // 判斷商品是否已經上架，如果沒有上架則拋出異常。
        if (!$product->on_sale) {
            // throw new \Exception('商品未上架');
            throw new InvalidRequestException('商品未上架');
        }

        $favored = false;

        // 用戶未登錄時返回的是 null，已登錄時返回的是對應的用戶對象
        if ($user = $request->user()) {
            // 從當前用戶已收藏的商品中搜索 id 為當前商品 id 的商品
            // boolval() 函數用於把值轉為布爾值
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }

        return view('products.show', ['product' => $product, 'favored' => $favored]);
    }

    public function favor(Product $product, Request $request)
    {
        $user = $request->user();

        if ($user->favoriteProducts()->find($product->id)) {
            return [];
        }

        $user->favoriteProducts()->attach($product);

        return [];
    }

    public function disfavor(Product $product, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($product);

        return [];
    }

    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites', ['products' => $products]);
    }

}
