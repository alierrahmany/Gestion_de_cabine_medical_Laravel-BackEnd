<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments'; // Nom de la table dans la base de données

    protected $fillable = [
        'name',
        'type',
        
    ]; // Définition des champs modifiables



}