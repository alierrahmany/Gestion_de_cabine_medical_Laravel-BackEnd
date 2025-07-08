<?php




namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    use HasFactory;
    
    // Spécifier explicitement le nom de la table
    protected $table = 'rendezvous';
    
    protected $fillable = [
        'patient_id',
        'date_heure',
        'motif',
    ];
    
    // Relation avec le modèle Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}