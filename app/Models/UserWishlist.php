<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'productID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productID');
    }
}
