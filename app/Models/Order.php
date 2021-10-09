<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderUUID',
        'userID',
        'bankID',
        'status',
        'invoiceID',
        'nameSend',
        'phone',
        'whatsapp',
        'provinceID',
        'city',
        'rt',
        'rw',
        'address',
        'postcode',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderID');
    }

    public function orderItemByShop($shopID)
    {
        return $this->orderItems()->where('shopID', $shopID);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
