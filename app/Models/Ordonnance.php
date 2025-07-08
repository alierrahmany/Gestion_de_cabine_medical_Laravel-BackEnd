<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $table = 'ordonnances';

    protected $fillable = [
        'patient_id',
        'date',
        'prescriptions',
        'notes',
    ];

    protected $casts = [
        'prescriptions' => 'array',
        'date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}