<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderUUID',
        'status',
        'userID',
        'shipmentID',
        'payment_token',
        'payment_url',
        'nameSend',
        'phone',
        'whatsapp',
        'grand_total',
        'ongkir',
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

    public function isPaid()
    {
        return $this->status > 1;
    }
}
