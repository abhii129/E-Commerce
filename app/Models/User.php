<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'number',
        'age',
        'address',
        'gender',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Automatically generate user_id after create
    protected static function booted()
    {
        static::created(function ($user) {
            if (!$user->user_id) {
                $first = strtolower(strtok($user->name, ' '));
                $rand = rand(10000, 99999);
                $candidate = $first . $rand;
                // Ensure uniqueness
                while (self::where('user_id', $candidate)->exists()) {
                    $rand = rand(10000, 99999);
                    $candidate = $first . $rand;
                }
                $user->user_id = $candidate;
                $user->save();
            }
        });
    }

        public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

        public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(Address::class)->where('is_default', true);
    }

        public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
