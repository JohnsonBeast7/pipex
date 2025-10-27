<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Auth;
class User extends Auth
{
    protected $fillable = [
        'username',
        'nickname',
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

}
