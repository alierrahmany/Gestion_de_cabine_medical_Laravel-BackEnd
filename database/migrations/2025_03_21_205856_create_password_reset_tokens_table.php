<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetTokensTable extends Migration
{
    public function up()
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // L'email est la clé primaire
            $table->string('token'); // Le token de réinitialisation
            $table->timestamp('created_at')->nullable(); // Date de création du token
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_reset_tokens');
    }
}