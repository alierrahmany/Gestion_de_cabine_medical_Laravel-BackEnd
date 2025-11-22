<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'prescriptions',
        'notes'
    ];

    protected $casts = [
        'prescriptions' => 'array',
        'date' => 'date'
    ];

    /**
     * Get the patient that owns the ordonnance.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Scope a query to search ordonnances.
     */
    public function scopeSearch($query, $search)
    {
        return $query->whereHas('patient', function ($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%");
        })->orWhere('notes', 'like', "%{$search}%");
    }
}