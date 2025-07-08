<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'description',
        'status',
        'request_date',
    ];

    /**
     * Relation avec l'équipement.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}