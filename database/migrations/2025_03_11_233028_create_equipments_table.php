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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('name'); // Nom de l'équipement
            $table->string('type'); // Type d'équipement (ex: Scanner, Imprimante 3D)
            $table->enum('status', ['actif', 'inactif', 'en maintenance'])->default('actif'); // Statut de l'équipement
            $table->date('last_maintenance')->nullable(); // Dernière date de maintenance
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};