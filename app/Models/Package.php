<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'package_type',
        'package_duration',
        'amount',
        'discount_amount',
        'details',
        'status',
    ];
}
