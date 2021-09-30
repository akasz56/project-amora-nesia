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
        'rating',
        'viewers',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shopID');
    }

    public function types()
    {
        return $this->hasMany(FlowerType::class, 'productID');
    }
    public function wraps()
    {
        return $this->hasMany(FlowerWrap::class, 'productID');
    }
    public function sizes()
    {
        return $this->hasMany(FlowerSize::class, 'productID');
    }
}
