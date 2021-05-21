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
        'numero_de_exe,plares',
    ];

    public $timestamps = false;

    public function exemplar()
    {
        return $this->hasMany( Exemplar::class);
    }
}
