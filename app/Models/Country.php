<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'iso',
        'name',
        'iso3',
        'numcode',
        'phonecode',
        'status'
    ];
}
