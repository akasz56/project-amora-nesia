<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowerSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'productID',
        'name',
        'flower_amount',
        'stock',
        'price',
    ];
}
