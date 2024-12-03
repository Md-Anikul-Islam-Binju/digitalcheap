<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'package_id',
        'product_name',
        'package_name',
        'package_product_name',
        'is_free_or_paid',// 1=free, 2=paid
        'price',
    ];
}
