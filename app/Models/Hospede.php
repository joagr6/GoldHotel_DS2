<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Hospede extends Authenticatable
{
    use Notifiable;

    protected $table = 'hospedes';

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone',
        'email',
        'cidade',
        'numcasa',
        'rua',
        'senha',
    ];

    protected $hidden = ['remember_token'];
}
