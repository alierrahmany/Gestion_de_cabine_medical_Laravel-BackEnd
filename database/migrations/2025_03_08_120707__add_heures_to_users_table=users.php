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
        // Check if columns exist before trying to add them
        if (!Schema::hasColumn('users', 'heure_debut') && !Schema::hasColumn('users', 'heure_fin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->time('heure_debut')->nullable();
                $table->time('heure_fin')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop columns if they exist
        if (Schema::hasColumn('users', 'heure_debut') && Schema::hasColumn('users', 'heure_fin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['heure_debut', 'heure_fin']);
            });
        }
    }
};

