<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'statusID',
        'orderID',
        'orderUUID',
        'userID',
        'shopID',
        'shipmentID',
        'productID',
        // 'productTypeID',
        // 'productWrapID',
        // 'productSizeID',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'orderUUID', 'orderUUID');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shopID');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productID');
    }
    // public function product_type()
    // {
    //     return $this->hasOne(ProductType::class, 'id', 'productTypeID');
    // }
    // public function product_wrap()
    // {
    //     return $this->hasOne(ProductWrap::class, 'id', 'productWrapID');
    // }
    // public function product_size()
    // {
    //     return $this->hasOne(ProductSize::class, 'id', 'productSizeID');
    // }
}
