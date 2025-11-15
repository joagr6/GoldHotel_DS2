<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'data_entrada',
        'data_saida',
        'status',
        'hospede_id',
        'quarto_id',
    ];

    /**
     * Relação com o hóspede
     * Uma reserva pertence a um hóspede.
     */
    public function hospede()
    {
        return $this->belongsTo(Hospede::class);
    }

    /**
     * Relação com o quarto
     * Uma reserva pertence a um quarto.
     */
    public function quarto()
    {
        return $this->belongsTo(Quarto::class);
    }

    /**
     * Relação com o pagamento
     * Uma reserva tem um pagamento (relacionamento 1:1)
     */
    public function pagamento()
    {
        return $this->hasOne(Pagamento::class);
    }
}
