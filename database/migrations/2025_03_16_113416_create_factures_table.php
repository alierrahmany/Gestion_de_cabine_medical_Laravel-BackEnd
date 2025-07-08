<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('factures', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        $table->date('date_facture');
        $table->decimal('montant', 8, 2);
        $table->string('statut');
        $table->text('details')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};