<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'productID',
        // 'productTypeID',
        // 'productWrapID',
        // 'productSizeID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productID');
    }

    // public function type()
    // {
    //     return $this->hasOne(ProductType::class, 'id', 'productTypeID');
    // }
    // public function wrap()
    // {
    //     return $this->hasOne(ProductWrap::class, 'id', 'productWrapID');
    // }
    // public function size()
    // {
    //     return $this->hasOne(ProductSize::class, 'id', 'productSizeID');
    // }
}
