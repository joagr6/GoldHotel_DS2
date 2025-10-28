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
        Schema::create('quartos', function (Blueprint $table) {
            $table->id();
            $table->string('capacidade',50);
            $table->double('valorDiaria',50);
            $table->string('status',20);
            $table->string('tipoQuarto',50);
            $table->string('imagem')->nullable(); 

            $table->timestamps();
        });
    }

     public function down(): void
    {
        Schema::dropIfExists('quartos');
    }
};
