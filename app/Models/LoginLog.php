<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'ip',
        'browser',
        'platform',
        'last_login',
        'user_agent',
    ];


}
