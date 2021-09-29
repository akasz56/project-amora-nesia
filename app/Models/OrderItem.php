<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderID',
        'orderUUID',
        'userID',
        'shopID',
        'productID',
        'productTypeID',
        'productWrapID',
        'productSizeID',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'orderUUID', 'orderUUID');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productID');
    }
    public function product_type()
    {
        return $this->hasOne(FlowerType::class, 'id', 'productTypeID');
    }
    public function product_wrap()
    {
        return $this->hasOne(FlowerWrap::class, 'id', 'productWrapID');
    }
    public function product_size()
    {
        return $this->hasOne(FlowerSize::class, 'id', 'productSizeID');
    }
}
