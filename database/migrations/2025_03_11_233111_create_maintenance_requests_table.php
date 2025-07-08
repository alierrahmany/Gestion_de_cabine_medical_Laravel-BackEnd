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
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')
                  ->constrained('equipments')
                  ->onDelete('cascade'); // Supprime la demande si l'équipement est supprimé
            
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null'); // Si l'utilisateur est supprimé, la demande reste
            
            $table->text('description');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamp('request_date')->useCurrent(); // Défaut: date actuelle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};