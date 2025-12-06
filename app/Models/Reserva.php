<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'data_entrada',
        'data_saida',
        'status',
        'hospede_id',
        'quarto_id',
    ];

   
    public function hospede()
    {
        return $this->belongsTo(Hospede::class);
    }
 
    
    public function quarto()
    {
        return $this->belongsTo(Quarto::class);
    }

    public function pagamento()
    {
        return $this->hasOne(Pagamento::class);
    }


    public function servicos()
    {
        return $this->belongsToMany(ServicoAdicional::class, 'reserva_servico', 'reserva_id', 'servico_id');

    }}
