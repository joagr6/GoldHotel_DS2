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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
             $table->foreignId('hospede_id')
                  ->constrained('hospedes')  
                  ->onDelete('cascade');//caso o hospede seja excluido, todas as reservas associadas a ele tembver,m são
                  
            $table->date('data_entrada');
            $table->date('data_saida');
            $table->string('status', 20);

            $table->foreignId('quarto_id')
                  ->constrained('quartos')   
                  ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
