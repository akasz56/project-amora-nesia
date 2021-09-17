<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // PublicID = [3 substr pertama toko] + [angka 1] + [productID + 300]

    protected $fillable = [
        'publicID',
        'shopID',
        'name',
        'description',
        'rating',
        'viewers',
    ];
}
