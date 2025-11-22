<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date_facture',
        'montant',
        'statut',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}