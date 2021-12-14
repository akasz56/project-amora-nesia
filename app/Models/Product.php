<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopID',
        'name',
        'description',
        'stock',
        'price',
        'rating',
        'viewers',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shopID');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'productID');
    }

    // public function types()
    // {
    //     return $this->hasMany(ProductType::class, 'productID');
    // }
    // public function wraps()
    // {
    //     return $this->hasMany(ProductWrap::class, 'productID');
    // }
    // public function sizes()
    // {
    //     return $this->hasMany(ProductSize::class, 'productID');
    // }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'productID', 'categoryID');
    }
}
