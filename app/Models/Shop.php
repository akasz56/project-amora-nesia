<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'addressID',
        'desc',
        'phone',
        'whatsapp',
        'email',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'shopID');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'addressID');
    }

    // public function getMaxRating() {}
    // public function getAvgRating() {}
    // public function getOrderItems($status = 'pending','done') {}
    // public function getSalesData() {}
}
