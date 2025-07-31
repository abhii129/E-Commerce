<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id',
        'number',
        'age',
        'address',
        'gender',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
