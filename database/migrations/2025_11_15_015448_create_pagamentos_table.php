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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')
                  ->unique()
                  ->constrained('reservas')
                  ->onDelete('cascade');
            $table->decimal('valor', 10, 2);
            $table->string('metodo_pagamento', 50); // cartao, pix, dinheiro, etc
            $table->string('status', 20)->default('pendente'); // pendente, pago, cancelado
            $table->dateTime('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
