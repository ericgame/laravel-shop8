<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'paice'
    ];

    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一個布爾類型的字段
    ];

    // 與商品SKU關聯
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

}
