<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuartoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quartos')->insert([
            [
                'capacidade' => '1 pessoa',
                'valorDiaria' => 150.00,
                'status' => 'disponível',
                'tipoQuarto' => 'Quarto Individual',
                'imagem' => 'images/quartos/quarto01.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'capacidade' => '2 pessoas',
                'valorDiaria' => 230.00,
                'status' => 'ocupado',
                'tipoQuarto' => 'Quarto Duplo',
                'imagem' => 'quartos/quartos/quarto02.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'capacidade' => '3 pessoas',
                'valorDiaria' => 320.00,
                'status' => 'disponível',
                'tipoQuarto' => 'Quarto Triplo',
                'imagem' => 'quartos/quartos/quarto03.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'capacidade' => '4 pessoas',
                'valorDiaria' => 400.00,
                'status' => 'em manutenção',
                'tipoQuarto' => 'Quarto Familiar',
                'imagem' => 'quartos/quartos/quarto04.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'capacidade' => '2 pessoas',
                'valorDiaria' => 350.00,
                'status' => 'disponível',
                'tipoQuarto' => 'Suíte Luxo',
                'imagem' => 'quartos/quartos/quarto05.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'capacidade' => '2 pessoas',
                'valorDiaria' => 500.00,
                'status' => 'disponível',
                'tipoQuarto' => 'Suíte Premium',
                'imagem' => 'quartos/quartos/quarto06.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'capacidade' => '1 pessoa',
                'valorDiaria' => 180.00,
                'status' => 'ocupado',
                'tipoQuarto' => 'Quarto Econômico',
                'imagem' => 'quartos/quartos/quarto07.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'capacidade' => '5 pessoas',
                'valorDiaria' => 600.00,
                'status' => 'disponível',
                'tipoQuarto' => 'Suíte Master',
                'imagem' => 'quartos/quartos/quarto08.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
