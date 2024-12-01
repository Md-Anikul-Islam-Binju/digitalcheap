<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'package_type',
        'image',

        'month_package_amount',
        'month_package_discount_amount',

        'half_year_package_amount',
        'half_year_package_discount_amount',

        'yearly_package_amount',
        'yearly_package_discount_amount',

        'details',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(PackageProduct::class);
    }

}
