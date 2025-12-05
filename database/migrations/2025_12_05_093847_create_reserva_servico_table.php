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
        Schema::create('reserva_servico', function (Blueprint $table) {
    $table->id();

    $table->foreignId('reserva_id')
          ->constrained('reservas')
          ->onDelete('cascade');

    $table->foreignId('servico_id')
          ->constrained('servicosAdicionais')
          ->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_servico');
    }
};
