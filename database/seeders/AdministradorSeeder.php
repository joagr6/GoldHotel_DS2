<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('administradores')->insert([
            [
                'nome' => 'Joao',
                'cpf' => '111',
                'data_nascimento' => '2010-10-10',
                'telefone' => '123',
                'senha' => bcrypt('123'),
            ],
            [
                'nome' => 'Mateus',
                'cpf' => '222',
                'data_nascimento' => '2010-10-10',
                'telefone' => '123',
                'senha' => bcrypt('123'),
            ],
            [
                'nome' => 'Gabriel',
                'cpf' => '333',
                'data_nascimento' => '2010-10-10',
                'telefone' => '123',
                'senha' => bcrypt('123'),
            ],
        ]);
    }
}
