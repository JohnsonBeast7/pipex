<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post',
        'user_id',
        'post',
        'edited_at'
    ];

    protected $casts = [
        'edited_at' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
