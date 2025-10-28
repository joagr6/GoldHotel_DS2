<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
             $table->foreignId('hospede_id')
                  ->constrained('hospedes')  
                  ->onDelete('cascade');
                  
            $table->date('data_entrada');
            $table->date('data_saida');
            $table->string('status', 20);

            $table->foreignId('quarto_id')
                  ->constrained('quartos')   
                  ->onDelete('cascade');


            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
