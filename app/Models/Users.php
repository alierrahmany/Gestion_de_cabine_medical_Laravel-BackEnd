<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'image',
        'last_login',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
