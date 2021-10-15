<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWrap extends Model
{
    use HasFactory;

    protected $fillable = [
        'productID',
        'name',
        'color',
        'stock',
        'price',
    ];
}
