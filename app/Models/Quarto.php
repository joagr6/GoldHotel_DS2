<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    protected $fillable = ['capacidade', 'valorDiaria', 'status', 'tipoQuarto'];
};