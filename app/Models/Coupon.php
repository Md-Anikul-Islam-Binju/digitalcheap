<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_code',
        'discount_amount',
        'start_date',
        'end_date',
        'use_limit',
        'amount_spend',
        'status',
    ];
}
