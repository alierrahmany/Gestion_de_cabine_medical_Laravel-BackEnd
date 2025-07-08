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
        'status',
        'last_maintenance',
    ]; // Définition des champs modifiables

    protected $casts = [
        'last_maintenance' => 'date',
    ]; // Cast de la colonne date

    /**
     * Définition des statuts possibles pour un équipement.
     */
    public static function statuses()
    {
        return ['actif', 'inactif', 'en maintenance'];
    }
}