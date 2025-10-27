<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nome', 'cpf', 'senha'];

    protected $hidden = ['senha'];

    public function getAuthPassword()
    {
        return $this->senha;
    }
}