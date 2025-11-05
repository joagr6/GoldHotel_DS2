<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administradores'; // 👈 Força o nome correto da tabela

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone',
        'senha',
    ];

    protected $hidden = [
        'senha',
    ];

    // ⚠️ Laravel espera por padrão o campo 'password', então precisamos ajustar
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
