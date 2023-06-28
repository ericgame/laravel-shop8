<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 創建 30 個商品
        $products = \App\Models\Product::factory()->count(30)->create();

        foreach ($products as $product) {
            // 創建 3 個 SKU，並且每個 SKU 的 `product_id` 字段都設為當前循環的商品 id
            $skus = \App\Models\ProductSku::factory()->count(3)->create(['product_id' => $product->id]);

            // 找出價格最低的 SKU 價格，把商品價格設置為該價格
            $product->update(['price' => $skus->min('price')]);
        }
    }
}
