<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = "users";

    protected $fillable = [
        'name', 'email', 'password', 'street', 'number', 'city', 'state', 'zip_code', 'country'
    ];
    

    // Evitar que estos datos se serialicen en las respuestas JSON
    protected $hidden = [
        'password',
    ];

    public function cart(): HasOne {
        return $this->hasOne(Cart::class);
    }
}
