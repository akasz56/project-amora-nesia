<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'provinceID',
        'city',
        'rt',
        'rw',
        'address',
        'postcode',
    ];

    public function province()
    {
        return DB::table('ref_province')->where('id', '=', $this->provinceID)->first()->name;
    }
}
