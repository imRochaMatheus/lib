<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'email',
        'senha',
        'nivel_de_acesso',
        'status'
    ];
}
