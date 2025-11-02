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
                'nome' => 'Administrador',
                'cpf' => '111',
                'data_nascimento' => '2010-10-10',
                'telefone' => '111',
                'senha' => bcrypt('111'),
            ],
        ]);
    }
}
