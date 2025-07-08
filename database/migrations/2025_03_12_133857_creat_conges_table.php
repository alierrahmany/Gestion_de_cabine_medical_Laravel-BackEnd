<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('type'); // ex: maladie, annuel, exceptionnel
            $table->string('statut')->default('en attente'); // accepté, refusé, en attente
            $table->text('motif')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conges');
    }
};