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
        Schema::create('administradors', function (Blueprint $table) {
           $table->id();
            $table->string('nome',100);
            $table->string('cpf',16);
            $table->date('data_nascimento',10);
            $table->string('telefone',20)->nullable();
            $table->string('senha',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradors');
    }
};
