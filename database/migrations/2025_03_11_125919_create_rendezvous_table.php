<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table patients
            $table->dateTime('date_heure'); // Date et heure du rendez-vous
            $table->text('motif')->nullable(); // Motif du rendez-vous (peut être null)
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
    }
};
