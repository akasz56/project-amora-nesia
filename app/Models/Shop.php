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
    
    // public function getAddress() {}
    // public function getFullAddress() {}
    // public function getMaxRating() {}
    // public function getAvgRating() {}
    // public function getOrderItems($status = 'pending','done') {}
    // public function getSalesData() {}
}
