<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_id',
        'number',
        'amount',
        'method',
        'token',
        'payloads',
        'payment_type',
        'va_number',
        'vendor_name',
        'biller_code',
        'bill_key',
        'order_id',
        'number',
        'method',
        'token',
        'payment_type',
    ];

    public static function generateCode()
    {
        $orderCode = Carbon::now()->format('dmY') . random_int(100, 999);
        return $orderCode;
    }
}
