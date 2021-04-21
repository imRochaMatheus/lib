<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    //
    protected $fillable = 
    [
        'codigo',
        'titulo',
        'autor',
        'editora',
        'edicao',
        'volume',
        'descricao',
        'numero_de_paginas',
    ];

    public function exemplar()
    {
        return $this->hasMany( Exemplar::class);
    }
}
