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
    {// Dans votre fichier de migration
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->string('username')->nullable();
    $table->string('email')->nullable();
    $table->string('password')->nullable();
    $table->enum('role', ['medcin', 'infirmier', 'secretaire', 'administratif', 'technicien']);
    $table->string('specialite')->nullable(); // Ajout du champ spécialité
    $table->string('image')->default('no_image.jpg');
    $table->tinyInteger('status')->default(1);
    $table->time('heure_debut')->nullable();
    $table->time('heure_fin')->nullable();
    $table->dateTime('last_login')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

