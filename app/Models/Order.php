<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
        'order_tracking_id',
        'user_id',
        'payment_method',
        'total',
        'status',
    ];
}
