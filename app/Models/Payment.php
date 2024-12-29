<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'status',
        'transaction_id',
        'payment_method',
        'payment_gateway',
        'payment_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
