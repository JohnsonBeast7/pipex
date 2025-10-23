<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;
class User extends Auth
{
    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
        'created_at' => 'date'
    ];

}
