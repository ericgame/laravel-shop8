<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\ProductSku;
use App\Exceptions\InvalidRequestException;
use App\Jobs\CloseOrder;
use Carbon\Carbon;

class OrderService
{
    public function store(User $user, UserAddress $address, $remark, $items)
    {
        // 開啟一個數據庫事務
        $order = \DB::transaction(function () use ($user, $address, $remark, $items) {
            // 更新此地址的最後使用時間
            $address->update(['last_used_at' => Carbon::now()]);
            // 創建一個訂單
            $order = new Order([
                'address' => [ // 將地址信息放入訂單中
                    'address' => $address->full_address,
                    'zip' => $address->zip,
                    'contact_name' => $address->contact_name,
                    'contact_phone' => $address->contact_phone,
                ],
                'remark' => $remark,
                'total_amount' => 0,
            ]);
            // 訂單關聯到當前用戶
            $order->user()->associate($user);
            // 寫入數據庫
            $order->save();

            $totalAmount = 0;
            // 遍歷用戶提交的 SKU
            foreach ($items as $data) {
                $sku = ProductSku::find($data['sku_id']);
                // 創建一個 OrderItem 並直接與當前訂單關聯
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price' => $sku->price,
                ]);
                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('該商品庫存不足');
                }
            }

            // 更新訂單總金額
            $order->update(['total_amount' => $totalAmount]);

            // 將下單的商品從購物車中移除
            // $skuIds = collect($items)->pluck('sku_id');
            // $user->cartItems()->whereIn('product_sku_id', $skuIds)->delete();
            $skuIds = collect($items)->pluck('sku_id')->all();
            app(CartService::class)->remove($skuIds);

            return $order;
        });

        dispatch(new CloseOrder($order, config('app.order_ttl')));

        return $order;
    }
}