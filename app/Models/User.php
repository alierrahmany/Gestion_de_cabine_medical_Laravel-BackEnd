<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public $incrementing = false; // ← Ajouter cette ligne

   // Dans app/Models/User.php
protected $fillable = [
    'id',
    'name',
    'email',
    'password',
    'role',
    'specialite', // Ajoutez ce champ
    'image',
    'status',
    'phone_number',
    'reset_code',
    'reset_token',
];

    protected $hidden = [
        'password',
    ];
}