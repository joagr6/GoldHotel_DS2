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
        Schema::create('servicosAdicionais', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->text('descricao');
            $table->decimal('valor', 10, 2);
            $table->string('status', 20);
            $table->string('imagem')->nullable(); // ← imagem opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicosAdicionais');
    }
};
