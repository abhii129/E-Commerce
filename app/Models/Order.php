<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['user_id', 'total', 'status'];

    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ADD THIS RELATIONSHIP:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
