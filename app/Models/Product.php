<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'amount',
        'discount_amount',
        'details',
        'link',
        'additional_information',
        'file',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
