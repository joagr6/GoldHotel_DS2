<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'pagamentos';

    protected $fillable = [
        'reserva_id',
        'valor',
        'metodo_pagamento',
        'status',
        'data_pagamento',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data_pagamento' => 'datetime',
    ];

    /**
     * Relação com a reserva
     * Um pagamento pertence a uma reserva (relacionamento 1:1)
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
