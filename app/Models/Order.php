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
        'invoiceID',
        'status',
        'nameSend',
        'phone',
        'whatsapp',
        'shipmentID',
        'provinceID',
        'city',
        'rt',
        'rw',
        'address',
        'postcode',
    ];

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class, 'orderID');
    }
}