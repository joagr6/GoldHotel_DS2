<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoAdicional extends Model
{
    protected $table = 'servicosAdicionais';

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'status',
        'imagem',
    ];

    public function reservas()
    {
        return $this->belongsToMany(
            Reserva::class,
            'reserva_servico', 
            'servico_id',      
            'reserva_id'       
        );
    }
}
