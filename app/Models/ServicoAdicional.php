<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoAdicional extends Model
{
    use HasFactory;

    protected $table = 'servicosAdicionais'; // nome da tabela no banco

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'status',
        'imagem',
    ];
}