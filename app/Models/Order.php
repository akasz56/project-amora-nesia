<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
