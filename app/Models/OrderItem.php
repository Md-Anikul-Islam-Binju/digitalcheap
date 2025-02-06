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
        'name',
        'duration',
        'device_access',
        'is_free_or_paid',//free or paid
        'price',
        'type',// product or package
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
